<?php

namespace Database\Seeders;

use Database\Seeders\BookCategorySeeder;
use Database\Seeders\BookSeeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\ReaderSeeder;
use Database\Seeders\RequestSeeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\WishlistSeeder;
use Database\Seeders\BookWishlistSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    
        $this->call(
            [
            CategorySeeder::class,
            BookSeeder::class,
            // BookCategorySeeder::class,
            // RoleSeeder::class,
            // ReaderSeeder::class,
            // RequestSeeder::class,
            // WishlistSeeder::class,
            // BookWishlistSeeder::class
        ]);
    }
    
}
