<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookWishlistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::create('book_wishlist', function (Blueprint $table) {
            $table->id('wishlist_id');
            $table->string('ISBN');
            $table->string('reader_id');
            $table->timestamps();
        });
        //
    }
}
