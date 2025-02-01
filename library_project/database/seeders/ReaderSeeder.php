<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReaderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::create('readers', function (Blueprint $table) {
            $table->id('reader_id');
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->string('phone_number');
            $table->timestamps();
        });
    }
        public function down(){
            Schema::dropIfExists('readers');
    }
}