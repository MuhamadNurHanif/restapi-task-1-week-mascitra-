<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::truncate();

        $superadmin = User::create([
            'name' => 'HRD',
            'username' => 'hrd_user',
            'email' => 'HRD@gmail.com',
            'password' => Hash::make('password'),
        ]);


        $superadmin->roles()->attach(Role::where('slug', 'HRD')->first());


        $karyawan = User::create([
            'name' => 'CEO',
            'username' => 'ceo_user',
            'email' => 'CEO@gmail.com',
            'password' => Hash::make('password'),
        ]);


        $karyawan->roles()->attach(Role::where('slug', 'CEO')->first());

        $karyawan = User::create([
            'name' => 'superadmin',
            'username' => 'superadmin_user',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('password'),
        ]);

        $karyawan->roles()->attach(Role::where('slug', 'superadmin')->first());
    }
}
