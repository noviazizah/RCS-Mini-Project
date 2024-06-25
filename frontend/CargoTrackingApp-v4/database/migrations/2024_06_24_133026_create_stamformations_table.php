<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('stamformations', function (Blueprint $table) {
            $table->increments('stamformation_id');
            $table->string('train_number', 20);
            $table->string('carriage_code', 20);
            $table->json('carriage_order'); // JSON untuk menyimpan urutan gerbong
            $table->timestamps();
    
            $table->foreign('train_number')->references('train_number')->on('trains')->onDelete('cascade');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('stamformations');
    }
    
};
