<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'first_name' => 'Ronver',
            'middle_name' => 'Alburo',
            'last_name' => 'Amper',
            'position' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123')
        ])->assignRole('admin');

          // Create staff user
          User::create([
            'first_name' => 'Jane',
            'middle_name' => 'ehhh',
            'last_name' => 'Doe',
            'position' => 'head',
            'email' => 'head@gmail.com',
            'password' => bcrypt('staff123')
        ])->assignRole('head');


        User::create([
            'first_name' => 'Charry',
            'middle_name' => 'Garol',
            'last_name' => 'Hetio',
            'position' => 'maintenance personnel',
            'email' => 'personnel@gmail.com',
            'password' => bcrypt('staff123')
        ])->assignRole('maintenance personnel');

    }
}
