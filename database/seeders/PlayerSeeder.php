<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Player;
use Illuminate\Support\Carbon;

class PlayerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        $players = [
            [
                'id_pemain' => 'SV001',
                'nama_pemain' => 'Cristiano Ronaldo',
                'cabang_olahraga' => 'Sepak Bola',
                'klub' => 'Al Nassr',
                'usia' => 40,
                'gambar' => 'pemain/placeholder.png',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id_pemain' => 'SV002',
                'nama_pemain' => 'Lionel Messi',
                'cabang_olahraga' => 'Sepak Bola',
                'klub' => 'Inter Miami',
                'usia' => 39,
                'gambar' => 'pemain/placeholder.png',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id_pemain' => 'SV003',
                'nama_pemain' => 'Stephen Curry',
                'cabang_olahraga' => 'Basket',
                'klub' => 'Golden State Warriors',
                'usia' => 38,
                'gambar' => 'pemain/placeholder.png',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id_pemain' => 'SV004',
                'nama_pemain' => 'Kobe Bryant',
                'cabang_olahraga' => 'Basket',
                'klub' => 'Los Angeles Lakers',
                'usia' => 41,
                'gambar' => 'pemain/placeholder.png',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id_pemain' => 'SV005',
                'nama_pemain' => 'Novak Djokovic',
                'cabang_olahraga' => 'Tenis',
                'klub' => 'Serbia',
                'usia' => 38,
                'gambar' => 'pemain/placeholder.png',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id_pemain' => 'SV006',
                'nama_pemain' => 'Rafael Nadal',
                'cabang_olahraga' => 'Tenis',
                'klub' => 'Spanyol',
                'usia' => 39,
                'gambar' => 'pemain/placeholder.png',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id_pemain' => 'SV007',
                'nama_pemain' => 'Kevin Sanjaya',
                'cabang_olahraga' => 'Badminton',
                'klub' => 'Indonesia',
                'usia' => 30,
                'gambar' => 'pemain/placeholder.png',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id_pemain' => 'SV008',
                'nama_pemain' => 'Jonatan Christie',
                'cabang_olahraga' => 'Badminton',
                'klub' => 'Indonesia',
                'usia' => 28,
                'gambar' => 'pemain/placeholder.png',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id_pemain' => 'SV009',
                'nama_pemain' => 'Max Verstappen',
                'cabang_olahraga' => 'Formula 1',
                'klub' => 'Red Bull Racing',
                'usia' => 28,
                'gambar' => 'pemain/placeholder.png',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id_pemain' => 'SV010',
                'nama_pemain' => 'Marc Marquez',
                'cabang_olahraga' => 'MotoGP',
                'klub' => 'Ducati Lenovo Team',
                'usia' => 33,
                'gambar' => 'pemain/placeholder.png',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        Player::insert($players);
    }
}
