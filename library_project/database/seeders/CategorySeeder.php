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
            "fiction", "mystery", "suspense",  
            "romance", "horror", "adventure", "comedy", "cooking", 
            "fantasy", "action", "kids", "thriller", "science fiction",
            "biography", "history", "self-help", "religion", "science", 
            "sports", "business", "economics", "politics", "education", 
            "technology", "engineering", "mathematics", "medicine", 
            "photography", "fashion", "comics", "manga", 
            "poetry", "short stories", "paranormal", 
            "supernatural", "western", "urban"
        ];

        foreach ($categories as $c)
        DB::table('categories')->insert([
            'category_name' => $c,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
