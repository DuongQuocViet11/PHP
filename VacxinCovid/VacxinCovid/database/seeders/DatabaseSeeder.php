<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('admin123'),
                'identify' => '123456',
                'dob' => '2000-01-01',
                'address' => '26 bà triệu',
                'telephone' => '0393656099',
                'allegry' => 'hen',
                'role' => '1'
            ]
        ]);
    }
}
