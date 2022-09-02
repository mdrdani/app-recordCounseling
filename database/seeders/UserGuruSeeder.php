<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserGuruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user = User::create([
            'name'      => 'Sekolah Darma Bangsa',
            'email'     => 'guru@gmail.com',
            'username' => 'guru',
            'password'  => bcrypt('password'),
        ]);

        //get role admin
        $role = Role::find(3);

        //assign role to user
        $user->assignRole($role);
    }
}
