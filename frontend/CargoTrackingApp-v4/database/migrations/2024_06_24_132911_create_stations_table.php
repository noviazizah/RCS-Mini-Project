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
        Schema::create('stations', function (Blueprint $table) {
            $table->string('station_code', 10)->primary();
            $table->string('station_name', 100);
            $table->double('latitude');
            $table->double('longitude');
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('stations');
    }
    
};
