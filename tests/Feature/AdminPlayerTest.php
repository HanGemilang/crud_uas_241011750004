<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Player;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminPlayerTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();

        // Create user
        $this->user = User::create([
            'name' => 'User Test',
            'email' => 'admin@company.com',
            'password' => bcrypt('password123'),
        ]);

        Storage::fake('public');
    }

    public function test_can_add_player_and_display_on_public_site(): void
    {
        // 1. Submit a new player via the Admin panel
        $image = UploadedFile::fake()->image('jude_bellingham.jpg');

        $response = $this->withSession([
            'user_id' => $this->user->id,
            'user_name' => $this->user->name,
        ])->post(route('admin.players.store'), [
            'id_pemain' => 'SV999',
            'nama_pemain' => 'Jude Bellingham Test',
            'cabang_olahraga' => 'Sepak Bola',
            'klub' => 'StartingVano Club',
            'usia' => 23,
            'gambar' => $image,
        ]);

        $response->assertRedirect(route('admin.players.index'));
        $this->assertDatabaseHas('players', [
            'id_pemain' => 'SV999',
            'nama_pemain' => 'Jude Bellingham Test',
        ]);

        // Get the saved player
        $player = Player::where('id_pemain', 'SV999')->first();
        $this->assertNotNull($player->gambar);

        // Verify image was stored on the public disk
        Storage::disk('public')->assertExists($player->gambar);

        // 2. Access the public players list page and verify it's displayed
        $publicResponse = $this->get(route('players'));
        $publicResponse->assertStatus(200);
        $publicResponse->assertSee('Jude Bellingham Test');

        // 3. Access the public player detail page and verify it's displayed
        $detailResponse = $this->get(route('players.show', $player->id));
        $detailResponse->assertStatus(200);
        $detailResponse->assertSee('Jude Bellingham Test');
        $detailResponse->assertSee('SV999');
        $detailResponse->assertSee('Sepak Bola');
        $detailResponse->assertSee('StartingVano Club');
        $detailResponse->assertSee('23 Tahun');

        // 4. Access the admin player detail page and verify it's displayed
        $adminDetailResponse = $this->withSession([
            'user_id' => $this->user->id,
            'user_name' => $this->user->name,
        ])->get(route('admin.players.show', $player->id));
        $adminDetailResponse->assertStatus(200);
        $adminDetailResponse->assertSee('Jude Bellingham Test');
        $adminDetailResponse->assertSee('SV999');
        $adminDetailResponse->assertSee('Sepak Bola');
        $adminDetailResponse->assertSee('StartingVano Club');
        $adminDetailResponse->assertSee('23 Tahun');
    }
}
