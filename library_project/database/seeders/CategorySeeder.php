<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['category_name' => 'Fiction'],
            ['category_name' => 'Non-fiction'],
            ['category_name' => 'Science'],
            ['category_name' => 'History'],
            ['category_name' => 'Biography'],
            ['category_name' => 'Children'],
            ['category_name' => 'Fantasy'],
            ['category_name' => 'Mystery'],
            ['category_name' => 'Romance'],
            ['category_name' => 'Horror'],
        ];

        DB::table('categories')->insert($categories);
    }
}