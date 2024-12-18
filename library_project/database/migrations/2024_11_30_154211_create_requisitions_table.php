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
        Schema::create('requisitions', function (Blueprint $table) {
            $table->id("requisition_id");
            $table->foreignId("reader_id")->constrained("readers", "reader_id")->ondelete("cascade");
            $table->bigInteger("ISBN");
            $table->foreign("ISBN")->references("ISBN")->on("books")->ondelete("cascade");
            $table->string("requisition_status");
            $table->timestamp("loan_date");
            $table->datetime("return_date");
            $table->time("delay");
            $table->float("price");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requisitions');
    }
};
