<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        $categories = [
            "Fiction", "Mystery", "Suspense",  
            "Romance", "Horror", "Adventure", "Comedy", "Cooking", 
            "Fantasy", "Action", "Kids", "Thriller", "Science Fiction",
            "Biography", "History", "Self-Help", "Religion", "Science", 
            "Sports", "Business", "Economics", "Politics", "Education", 
            "Technology", "Engineering", "Mathematics", "Medicine", 
            "Photography", "Fashion", "Comics", "Manga", 
            "Poetry", "Short Stories", "Paranormal", 
            "Supernatural", "Western", "Urban"
        ];

        foreach ($categories as $c)
        DB::table('categories')->insert([
            'category_name' => $c,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
