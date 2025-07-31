<?php

namespace Database\Seeders;

use App\Models\SuratKeluar;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password'=> bcrypt('password'),
        ]);
        // $data = SuratKeluar::factory()->make()->toArray();
        // dd($data); 
        // SuratKeluar::factory(50)->create();
    }
}
