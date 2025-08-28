<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            ['name' => 'suratmasuk.create', 'display_name' => 'Tambah Surat Masuk'],
            ['name' => 'suratmasuk.edit',   'display_name' => 'Edit Surat Masuk'],
            ['name' => 'suratmasuk.delete', 'display_name' => 'Hapus Surat Masuk'],

            ['name' => 'suratkeluar.create','display_name' => 'Tambah Surat Keluar'],
            ['name' => 'suratkeluar.edit',  'display_name' => 'Edit Surat Keluar'],
            ['name' => 'suratkeluar.delete','display_name' => 'Hapus Surat Keluar'],

            ['name' => 'pinjamsurat.create','display_name' => 'Tambah Peminjaman Surat'],
            ['name' => 'pinjamsurat.edit',  'display_name' => 'Edit Peminjaman Surat'],
            ['name' => 'pinjamsurat.delete','display_name' => 'Hapus Peminjaman Surat'],

            ['name' => 'kelolauser.create', 'display_name' => 'Tambah User'],
            ['name' => 'kelolauser.edit',   'display_name' => 'Edit User'],
            ['name' => 'kelolauser.delete', 'display_name' => 'Hapus User'],

            ['name' => 'izin.create',       'display_name' => 'Tambah Perizinan'],
            ['name' => 'izin.edit',         'display_name' => 'Edit Perizinan'],
            ['name' => 'izin.delete',       'display_name' => 'Hapus Perizinan'],
        ];

        foreach ($permissions as $key => $value){
        Permission::updateOrCreate(
            ['name' => $value['name']],
            ['display_name' => $value['display_name']]
            );
        }
    }
}
