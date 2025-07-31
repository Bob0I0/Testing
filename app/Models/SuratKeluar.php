<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DateTime;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SuratKeluar extends Model
{
    use HasFactory;

    protected $fillable=["nomor_surat",
    "tujuan_surat", "perihal", "tanggal_surat",
    "jenis_surat", "file", "nama_asli_file"];

    // Tambahkan properti $casts ini
    protected $casts = [
        'tanggal_surat' => 'date', // Ini akan memastikan Laravel memperlakukan kolom ini sebagai tanggal
    ];

}
