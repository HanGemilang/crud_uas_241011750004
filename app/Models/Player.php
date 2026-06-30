<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Player extends Model
{
    use HasFactory;

    protected $table = 'players';

    protected $fillable = [
        'id_pemain',
        'gambar',
        'nama_pemain',
        'cabang_olahraga',
        'klub',
        'usia',
    ];
}
