<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
      
        $superadmin = User::create([
            'name' => 'HRD',
            'email' => 'HRD@gmail.com',
            'password' => bcrypt('password'),
        ]);

    
        $superadmin->roles()->attach(Role::where('slug', 'HRD')->first());

       
        $karyawan = User::create([
            'name' => 'CEO',
            'email' => 'CEO@gmail.com',
            'password' => bcrypt('password'),
        ]);

        
        $karyawan->roles()->attach(Role::where('slug', 'CEO')->first());
    }
}
