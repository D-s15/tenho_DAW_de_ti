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
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->enum ('request_status', ['em análise', 'rejeitado', 'aprovado', 'devolvido']);
            $table->date('due_date')->nullable();
            $table->date('return_date')->nullable();
            $table->date('request_date');
            $table->time('delay');
            $table->float('price')->default(0);
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requests');
    }
};
