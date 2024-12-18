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
        Schema::create('book_category', function (Blueprint $table) {
            $table->bigInteger("ISBN");
            $table->foreign("ISBN")->references("ISBN")->on("books")->ondelete("cascade");
            $table->foreignId("category_id")->constrained("categories", "category_id")->ondelete("cascade");
            $table->timestamps();

            $table->primary(["ISBN", "category_id"]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_category');
    }
};
