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
        Schema::create('readers', function (Blueprint $table) {
            $table->id("reader_id");
            $table->foreignId("role_id")->constrained("roles", "role_id")->onDelete("cascade");
            $table->string("email");
            $table->string("name");
            $table->string("password");
            $table->integer("phone_number");
            $table->boolean("blocked");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('readers');
    }
};
