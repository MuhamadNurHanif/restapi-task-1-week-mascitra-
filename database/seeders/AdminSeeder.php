<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        Admin::create([
            'id' => \Illuminate\Support\Str::uuid(),
            'name' => 'Admin',
            'username' => 'admin',
            'phone' => '081234567890',
            'email' => 'admin@example.com',
            'password' => Hash::make('pastibisa'),
        ]);
    }
}
