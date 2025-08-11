<?php 
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BookSeeder extends Seeder
{
    public function run()
    {
        DB::table('books')->insert([
            [
                'title' => 'The Great Gatsby',
                'author' => 'F. Scott Fitzgerald',
                'isbn' => '9780743273565',
                'published_year' => 1925,
                'page_number' => 180,
                'cover' => 'great_gatsby.jpg',
                'publisher' => 'Scribner',
                'sinopse' => 'A story of the mysteriously wealthy Jay Gatsby and his love for the beautiful Daisy Buchanan.',
                'available' => true,
                'stock' => 15,
                'edition' => '1st Edition',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'To Kill a Mockingbird',
                'author' => 'Harper Lee',
                'isbn' => '9780061120084',
                'published_year' => 1960,
                'page_number' => 281,
                'cover' => 'to_kill_a_mockingbird.jpg',
                'publisher' => 'J.B. Lippincott & Co.',
                'sinopse' => 'A novel about the serious issues',
                'edition' => '1st Edition',
                'available' => true,
                'stock' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => '1984',
                'author' => 'George Orwell',
                'isbn' => '9780451524935',
                'published_year' => 1949,
                'page_number' => 328,
                'cover' => '1984.jpg',
                'publisher' => 'Secker & Warburg',
                'sinopse' => 'A dystopian social science fiction novel and cautionary tale about the dangers of totalitarianism.',
                'available' => true,
                'stock' => 5,
                'edition' => '1st Edition',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}