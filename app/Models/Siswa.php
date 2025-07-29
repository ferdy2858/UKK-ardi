<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Siswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'nis',
        'kelas',
        'saldo', // tambahkan ini juga biar bisa diisi
    ];

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class);
    }
}
