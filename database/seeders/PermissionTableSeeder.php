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

        // permission role
        Permission::create(['name' => 'role-list', 'guard_name' => 'web']);
        Permission::create(['name' => 'role-create', 'guard_name' => 'web']);
        Permission::create(['name' => 'role-edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'role-delete', 'guard_name' => 'web']);

        // permission users
        Permission::create(['name' => 'user-list', 'guard_name' => 'web']);
        Permission::create(['name' => 'user-create', 'guard_name' => 'web']);
        Permission::create(['name' => 'user-edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'user-delete', 'guard_name' => 'web']);

        // permission tahun ajaran
        Permission::create(['name' => 'tahunajaran-list', 'guard_name' => 'web']);
        Permission::create(['name' => 'tahunajaran-create', 'guard_name' => 'web']);
        Permission::create(['name' => 'tahunajaran-edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'tahunajaran-delete', 'guard_name' => 'web']);

        // permission siswa
        Permission::create(['name' => 'siswa-list', 'guard_name' => 'web']);
        Permission::create(['name' => 'siswa-create', 'guard_name' => 'web']);
        Permission::create(['name' => 'siswa-edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'siswa-delete', 'guard_name' => 'web']);

        // permission note
        Permission::create(['name' => 'note-list', 'guard_name' => 'web']);
        Permission::create(['name' => 'note-create', 'guard_name' => 'web']);
        Permission::create(['name' => 'note-edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'note-delete', 'guard_name' => 'web']);

        // permission kelas
        Permission::create(['name' => 'kelas-list', 'guard_name' => 'web']);
        Permission::create(['name' => 'kelas-create', 'guard_name' => 'web']);
        Permission::create(['name' => 'kelas-edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'kelas-delete', 'guard_name' => 'web']);
    }
}
