<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DateTime;
use Illuminate\Database\Eloquent\Casts\Attribute;

class SuratMasuk extends Model
{
    protected $table = 'surat_masuk';
    
    protected $fillable = ["nomor_surat",
                            "asal_surat",
                            "perihal",
                            "tanggal_surat",
                            "jenis_surat",
                            "file"];
    
    public function setTanggalSuratAttribute($value)
    {
        $value = trim($value);
        $date = DateTime::createFromFormat('d/m/Y', $value);

        if (!$date) {
            $date = DateTime::createFromFormat('m/d/Y', $value);
        }

        if ($date) {
            $this->attributes['tanggal_surat'] = $date->format('Y-m-d'); 
        }
    }

    // Accessor: Mengonversi YYYY-MM-DD dari DB menjadi DD-MM-YYYY untuk TAMPILAN
    protected function tanggalSurat(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => DateTime::createFromFormat('Y-m-d', $value)->format('d/m/Y'),
        );
    }
}
