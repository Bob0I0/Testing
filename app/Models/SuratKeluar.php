<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SuratKeluar extends Model
{
    use HasFactory;

    protected $fillable=["nomor_surat",
    "tujuan_surat", "perihal", "tanggal_surat",
    "jenis_surat", "file", "nama_asli_file"];

    protected $casts = [
        'tanggal_surat' => 'date',
    ];

}
