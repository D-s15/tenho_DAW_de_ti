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
        schema::create('library_users', function (Blueprint $table) {
            $table->id();
            $table->enum('user_type', ['admin', 'member', 'reader']);
            $table->string('username');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        schema::dropIfExists('library_users');
    }
};
