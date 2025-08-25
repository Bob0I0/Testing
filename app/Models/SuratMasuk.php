<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratMasuk extends Model
{   
    protected $fillable = ["nomor_surat",
                            "asal_surat",
                            "perihal",
                            "tanggal_surat",
                            "jenis_surat",
                            "file",
                            "nama_asli_file"];
    protected $casts = [
        'tanggal_surat' => 'date',
    ];

}
