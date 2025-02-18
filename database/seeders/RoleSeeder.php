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
        ]);

        // Menambahkan role karyawan
        Role::create([
            'name' => 'HRD',
            'slug' => 'HRD',
        ]);
    }
}
