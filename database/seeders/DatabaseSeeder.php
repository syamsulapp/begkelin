<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password'),
            ]
        ]);

        DB::table('users')->insert([
            [
                'name' => 'User1',
                'email' => 'user1@gmail.com',
                'phone_number' => '083891428869',
                'alamat' => 'Kabupaten Tangerang',
                'password' => Hash::make('password'),
            ]
        ]);

        DB::table('pemilik_bengkels')->insert([
            [
                'name' => 'Owner1',
                'email' => 'owner1@gmail.com',
                'phone_number' => '083891428869',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Owner2',
                'email' => 'owner2@gmail.com',
                'phone_number' => '083891428869',
                'password' => Hash::make('password'),
            ]
        ]);

        DB::table('category_kendaraans')->insert([
            [
                'name' => 'Mobil',
            ],
            [
                'name' => 'Motor',
            ]
        ]);
    }
}
