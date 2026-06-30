<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Player;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class PlayerController extends Controller
{
    /**
     * Display a listing of the players on the public page.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $query = Player::latest();

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nama_pemain', 'like', '%' . $search . '%')
                  ->orWhere('cabang_olahraga', 'like', '%' . $search . '%')
                  ->orWhere('klub', 'like', '%' . $search . '%');
            });
        }

        $players = $query->paginate(6);
        return view('pages.players', compact('players', 'search'));
    }

    /**
     * Display the specified player.
     */
    public function show($id)
    {
        $player = Player::findOrFail($id);
        return view('pages.player-detail', compact('player'));
    }

    /**
     * Display the specified player on the admin panel.
     */
    public function adminShow($id)
    {
        $player = Player::findOrFail($id);
        return view('admin.players.show', compact('player'));
    }

    /**
     * Display a listing of the players on the admin panel.
     */
    public function adminIndex(Request $request)
    {
        $players = Player::latest()->get();
        return view('admin.players.index', compact('players'));
    }

    /**
     * Show the form for creating a new player.
     */
    public function create()
    {
        return view('admin.players.create');
    }

    /**
     * Store a newly created player in database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_pemain' => 'required|unique:players,id_pemain',
            'nama_pemain' => 'required|min:3',
            'cabang_olahraga' => 'required',
            'klub' => 'required',
            'usia' => 'required|numeric|min:15|max:50',
            'gambar' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'id_pemain.required' => 'ID Atlet wajib diisi.',
            'id_pemain.unique' => 'ID Atlet sudah terdaftar.',
            'nama_pemain.required' => 'Nama atlet wajib diisi.',
            'nama_pemain.min' => 'Nama atlet minimal 3 karakter.',
            'cabang_olahraga.required' => 'Cabang olahraga wajib diisi.',
            'klub.required' => 'Klub wajib diisi.',
            'usia.required' => 'Usia wajib diisi.',
            'usia.numeric' => 'Usia harus berupa angka.',
            'usia.min' => 'Usia minimal adalah 15 tahun.',
            'usia.max' => 'Usia maksimal adalah 50 tahun.',
            'gambar.required' => 'Gambar wajib diunggah.',
            'gambar.image' => 'File harus berupa gambar.',
            'gambar.mimes' => 'Format gambar harus berupa jpg, jpeg, atau png.',
            'gambar.max' => 'Ukuran gambar maksimal adalah 2MB.',
        ]);

        $data = $request->only(['id_pemain', 'nama_pemain', 'cabang_olahraga', 'klub', 'usia']);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('pemain', $filename, 'public');
            $data['gambar'] = 'pemain/' . $filename;
        }

        Player::create($data);

        return redirect()->route('admin.players.index')->with('success', 'Data atlet berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified player.
     */
    public function edit($id)
    {
        $player = Player::findOrFail($id);
        return view('admin.players.edit', compact('player'));
    }

    /**
     * Update the specified player in database.
     */
    public function update(Request $request, $id)
    {
        $player = Player::findOrFail($id);

        $request->validate([
            'id_pemain' => 'required|unique:players,id_pemain,' . $player->id,
            'nama_pemain' => 'required|min:3',
            'cabang_olahraga' => 'required',
            'klub' => 'required',
            'usia' => 'required|numeric|min:15|max:50',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'id_pemain.required' => 'ID Atlet wajib diisi.',
            'id_pemain.unique' => 'ID Atlet sudah terdaftar.',
            'nama_pemain.required' => 'Nama atlet wajib diisi.',
            'nama_pemain.min' => 'Nama atlet minimal 3 karakter.',
            'cabang_olahraga.required' => 'Cabang olahraga wajib diisi.',
            'klub.required' => 'Klub wajib diisi.',
            'usia.required' => 'Usia wajib diisi.',
            'usia.numeric' => 'Usia harus berupa angka.',
            'usia.min' => 'Usia minimal adalah 15 tahun.',
            'usia.max' => 'Usia maksimal adalah 50 tahun.',
            'gambar.image' => 'File harus berupa gambar.',
            'gambar.mimes' => 'Format gambar harus berupa jpg, jpeg, atau png.',
            'gambar.max' => 'Ukuran gambar maksimal adalah 2MB.',
        ]);

        $data = $request->only(['id_pemain', 'nama_pemain', 'cabang_olahraga', 'klub', 'usia']);

        if ($request->hasFile('gambar')) {
            // Delete old image if it exists in storage
            if ($player->gambar) {
                Storage::disk('public')->delete($player->gambar);
            }

            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('pemain', $filename, 'public');
            $data['gambar'] = 'pemain/' . $filename;
        }

        $player->update($data);

        return redirect()->route('admin.players.index')->with('success', 'Data atlet berhasil diperbarui.');
    }

    /**
     * Remove the specified player from database.
     */
    public function destroy($id)
    {
        $player = Player::findOrFail($id);

        if ($player->gambar) {
            Storage::disk('public')->delete($player->gambar);
        }

        $player->delete();

        return redirect()->route('admin.players.index')->with('success', 'Data atlet berhasil dihapus.');
    }

    /**
     * Export all players as a PDF report.
     */
    public function exportPdf()
    {
        $players = Player::latest()->get();
        
        $pdf = Pdf::loadView('admin.players.report', compact('players'))
                  ->setOptions([
                      'isRemoteEnabled' => true,
                      'defaultFont' => 'Helvetica',
                  ]);

        return $pdf->download('laporan-data-atlet-startingvano-' . date('Y-m-d') . '.pdf');
    }
}
