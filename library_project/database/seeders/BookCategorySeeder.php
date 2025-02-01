<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::create('book_categories', function (Blueprint $table) {
            $table->id('ISBN');
            $table->id('category_id');
            $table->timestamps();
        });
        //
    }

    public function down(){
        Schema::dropIfExists('book_categories');
    }
}
