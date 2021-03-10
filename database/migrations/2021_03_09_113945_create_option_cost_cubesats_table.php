<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOptionCostCubesatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('option_cost_cubesats', function (Blueprint $table) {
            $table->id();
            $table->float('cost');
            $table->foreignId('option_id')->references('id')->on('options')
                  ->unsigned()
                  ->nullable()
                  ->onDelete('cascade');
            $table->foreignId('cost_cubesat_id')->references('id')->on('cost_cubesats')
                  ->unsigned()
                  ->nullable()
                  ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('option_cost_cubesats');
    }
}
