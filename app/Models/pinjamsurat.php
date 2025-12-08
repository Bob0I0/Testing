<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PinjamSurat extends Model
{
    protected $fillable=["nomor_surat",
    "nama_peminjam", "perihal", "tanggal_pinjam",
    "tanggal_kembali", "status"];

    protected $casts = [
        'tanggal_pinjam' => 'date',
        'tanggal_kembali' => 'date',
    ];
}
