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
        Schema::create('library_user_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('library_user_id');
            $table->unsignedBigInteger('request_id');
            $table->timestamps();

            $table->foreign('library_user_id')->references('id')->on('library_users')->onDelete('cascade');
            $table->foreign('request_id')->references('id')->on('requests')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        schema::dropIfExists('library_user_requests');
    }
};
