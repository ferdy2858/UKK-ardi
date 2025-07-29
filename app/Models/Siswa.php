<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    // Biarkan kosong jika nama tabel sudah sesuai konvensi
    // protected $table = 'siswas';

    protected $fillable = [
        'nama',
        'nis',
        'kelas',
    ];
}
