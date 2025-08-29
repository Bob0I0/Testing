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
        $jenisSurat = ['Internal', 'Eksternal', 'Pemberitahuan', 'Undangan', 'Memo'];
        $generatedDate = $this->faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d');
        return [
            'nomor_surat' => sprintf('%03d', $this->faker->unique()->numberBetween(1, 999)) . '/' .
                             strtoupper($this->faker->randomLetter() . $this->faker->randomLetter()) . '/' .
                             'UDDPNK/' .
                             date('m') . '/' .
                             date('Y'),
            'tujuan_surat' => $this->faker->company(), 
            'perihal' => $this->faker->sentence(mt_rand(3, 7)), 
            'tanggal_surat' => $this->faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d'), 
            'jenis_surat' => $this->faker->randomElement($jenisSurat), 
            'file' => 'public/surat_files/' . Str::random(10) . '.pdf',         ];
    }
}

