<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RequisitionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::create('requisitions', function (Blueprint $table) {
            $table->id('requisition_id');
            $table->int('reader_id');
            $table->string('ISBN');
            $table->string('request_status');
            $table->string('loan_date');
            $table->string('return_date');
            $table->string('delay');
            $table->string('price');
            $table->timestamps();
        });
        //
    }

    public function down(){
        Schema::dropIfExists('requisitions');
    }
}
