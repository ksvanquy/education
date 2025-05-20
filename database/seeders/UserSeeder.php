<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Nguyen Van A',
                'email' => 'ksvanquy@gmail.com',
                'password' => Hash::make('ksvanquy'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Nguyen Van B',
                'email' => 'ksvanquy1@gmail.com',
                'password' => Hash::make('ksvanquy1'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Nguyen Van C',
                'email' => 'c@example.com',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}