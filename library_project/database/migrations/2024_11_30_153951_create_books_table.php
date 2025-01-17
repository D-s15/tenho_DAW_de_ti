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
            $table->String("ISBN")->unique();
            $table->string("title");
            $table->integer("page_number")->nullable();
            $table->string("author");
            $table->string("publisher");
            $table->string("cover");
            $table->string("release_date");
            $table->integer("edition")->nullable();
            $table->string("sinopse");
            $table->boolean("available");
            $table->integer("stock");
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
