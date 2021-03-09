<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSatellitePositionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('satelite_position');
        Schema::create('satellite_position_characteristic', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('max_height')->nullable();
            $table->integer('max_length')->nullable();
            $table->integer('max_width')->nullable();
            $table->integer('max_mass')->nullable();
            $table->timestamps();
        });

        Schema::create('satellite_position', function (Blueprint $table) {
            $table->id();
            $table->integer('position')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('satellite_position_characteristic_id');
            $table->foreign('satellite_position_characteristic_id')
                ->references('id')
                ->on('satellite_position_characteristic')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('satellite_position');
    }
}
