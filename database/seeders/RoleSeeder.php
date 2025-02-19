<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {
        // Menambahkan role superadmin
        Role::create([
            'name' => 'CEO',
            'slug' => 'CEO',
            'guard_name' => 'web',
        ]);

        // Menambahkan role karyawan
        Role::create([
            'name' => 'HRD',
            'slug' => 'HRD',
            'guard_name' => 'web',
        ]);

        Role::create([
            'name' => 'superadmin',
            'slug' => 'superadmin',
            'guard_name' => 'web',
        ]);
    }
}
