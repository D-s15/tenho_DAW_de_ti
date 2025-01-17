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
        Schema::create('book_wishlists', function (Blueprint $table) {
            $table->foreignid("wishlist_id")->constrained("wishlists", "wishlist_id")->onDelete("cascade");
            $table->String("ISBN");
            $table->foreign("ISBN")->references("ISBN")->on("books")->ondelete("cascade");
            $table->timestamps();

            $table->primary(['wishlist_id', "ISBN"]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_wishlists');
    }
};
