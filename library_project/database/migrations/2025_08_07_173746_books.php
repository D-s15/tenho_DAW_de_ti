<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->unsignedBigInteger('ISBN')->unique()->primary();
            $table->string('title');
            $table->integer('page_number');
            $table->string('author');
            $table->string('cover');
            $table->year('published_year');
            $table->string('publisher');
            $table->string('edition');
            $table->text('sinopse');
            $table->boolean('available');
            $table->integer('stock');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
