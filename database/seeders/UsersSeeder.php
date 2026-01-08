<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use function Symfony\Component\Clock\now;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'username' => 'mirza',
                'email' => 'mirza@ccplus.com',
                'password' => Hash::make('mirza123'),
                'created_at' => now(),
                'updated_at' => now(),
                'role_id' => '1'
            ],
            [
                'username' => 'admin',
                'email' => 'admin@ccplus.com',
                'password' => Hash::make('admin123'),
                'created_at' => now(),
                'updated_at' => now(),
                'role_id' => '1'
            ],
            [
                'username' => 'customer',
                'email' => 'customer@gmail.com',
                'password' => Hash::make('customer123'),
                'created_at' => now(),
                'updated_at' => now(),
                'role_id' => '2'
            ],
        ]);
    }
}
