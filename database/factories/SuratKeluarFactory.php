<?php

namespace Database\Factories;

use App\Models\SuratKeluar;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str; // Untuk UUID jika diperlukan untuk nomor surat unik

class SuratKeluarFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SuratKeluar::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Mendefinisikan beberapa jenis surat yang mungkin
        $jenisSurat = ['Internal', 'Eksternal', 'Pemberitahuan', 'Undangan', 'Memo'];
        $generatedDate = $this->faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d');
        // --- DEBUGGING BARIS INI ---
        // dd($generatedDate); // Ini akan menampilkan tanggal yang dihasilkan oleh faker
        // --- AKHIR DEBUGGING ---
        return [
            // 'nomor_surat' harus unik dan string dengan format XXX/AA/UDDPNK/MM/YYYY
            // XXX: Angka 3 digit unik
            // AA: 2 huruf acak (kapital)
            // UDDPNK: String tetap
            // MM: Bulan saat ini
            // YYYY: Tahun saat ini
            'nomor_surat' => sprintf('%03d', $this->faker->unique()->numberBetween(1, 999)) . '/' .
                             strtoupper($this->faker->randomLetter() . $this->faker->randomLetter()) . '/' .
                             'UDDPNK/' .
                             date('m') . '/' .
                             date('Y'),
            'tujuan_surat' => $this->faker->company(), // Nama perusahaan atau organisasi
            'perihal' => $this->faker->sentence(mt_rand(3, 7)), // Kalimat pendek untuk perihal
            'tanggal_surat' => $this->faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d'), // Tanggal dalam 1 tahun terakhir
            'jenis_surat' => $this->faker->randomElement($jenisSurat), // Memilih dari array jenis surat
            'file' => 'public/surat_files/' . Str::random(10) . '.pdf', // Path file dummy
            // Catatan: Untuk 'file', ini hanya string path dummy.
            // Tidak ada file fisik yang akan dibuat.
            // Jika Anda ingin file fisik, Anda perlu menggunakan package seperti 'fakerphp/faker-file'
            // atau membuat logika kustom untuk menyimpan file dummy.
        ];
    }
}

