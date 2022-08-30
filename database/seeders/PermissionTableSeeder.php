<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $permissions = [
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'kelas-list',
            'kelas-create',
            'kelas-edit',
            'kelas-delete',
            'note-list',
            'note-create',
            'note-edit',
            'note-delete',
            'siswa-list',
            'siswa-create',
            'siswa-edit',
            'siswa-delete',
            'tahunajaran-list',
            'tahunajaran-create',
            'tahunajaran-edit',
            'tahunajaran-delete'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
