<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Position;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminPosition = Position::create(['description' => 'Admin']);

        User::create([
            'first_name' => 'Ronver',
            'middle_name' => 'Alburo',
            'last_name' => 'Amper',
            'age' => '24',
            'bdate' => 'june 26, 1999',
            'email' => 'admin@gmail.com',
            'contnum' => '09269325483',
            'position_id' => $adminPosition->id, 
            'idnum' => '201901160',
            'office' => 'CSIT Office',
            'password' => bcrypt('admin123')
        ])->assignRole('admin');

          // Create staff user
          $headPosition = Position::create(['description' => 'Head']);
          User::create([
            'first_name' => 'Jane',
            'middle_name' => 'ehhh',
            'last_name' => 'Doe',
            'age' => '20',
            'bdate' => 'june 26, 1998',
            'email' => 'head@gmail.com',
            'contnum' => '09269325482',
            'position_id' =>  $headPosition->id, 
            'idnum' => '201901161',
            'office' => 'BGO',
            'password' => bcrypt('staff123')
        ])->assignRole('Head');


        // User::create([
        //     'first_name' => 'Charry',
        //     'middle_name' => 'Garol',
        //     'last_name' => 'Hetio',
        //     'age' => '20',
        //     'bdate' => 'june 26, 1998',
        //     'email' => 'personnel@gmail.com',
        //     'contnum' => '09269325481',
        //     'idnum' => '201901162',
        //     'office' => 'BGO',
        //     'password' => bcrypt('staff123')
        // ])->assignRole('maintenance personnel');

    }
}
