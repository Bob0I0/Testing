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
        $permissions=[
            'suratmasuk.create',
            'suratmasuk.edit',
            'suratmasuk.delete',
            'suratkeluar.create',
            'suratkeluar.edit',
            'suratkeluar.delete',
            'pinjamsurat.create',
            'pinjamsurat.edit',
            'pinjamsurat.delete',
            'kelolauser.create',
            'kelolauser.edit',
            'kelolauser.delete',
            'izin.create',
            'izin.edit',
            'izin.delete',
        ];

        foreach ($permissions as $key => $value){
            Permission::create(['name' => $value]);
        };
    }
}
