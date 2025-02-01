<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->string('ISBN');
            $table->string('title');
            $table->int("page_number")->nullable();
            $table->string('author');
            $table->string('publisher');
            $table->string('release_year');
            $table->string('edition');
            $table->boolean("available");
            $table->int("stock");
            $table->string('cover');
            $table->string('stock');
            $table->timestamps();
        });
    }

    public function down(){
        Schema::dropIfExists('books');
    }
}
