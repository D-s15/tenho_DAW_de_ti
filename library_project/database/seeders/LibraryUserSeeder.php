<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LibraryUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('library_users')->insert([
            [
                'name' => 'Alice Johnson',
                'email' => 'alice@example.com',
                'password' => bcrypt('password123'),
                'phone' => '+351 123 456 789',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bob Smith',
                'email' => 'bob@example.com',
                'password' => bcrypt('password123'),
                'phone' => '+351 987 654 321',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Charlie Brown',
                'email' => 'charlie@example.com',
                'password' => bcrypt('password123'),
                'phone' => '+351 456 789 123',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}