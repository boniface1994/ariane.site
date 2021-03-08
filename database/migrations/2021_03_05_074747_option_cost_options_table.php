<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class OptionCostOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('option_cost_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('option_id')->references('id')->on('options')
                  ->unsigned()
                  ->nullable()
                  ->onDelete('cascade');
            $table->foreignId('option_cost_id')->references('id')->on('option_costs')
                  ->unsigned()
                  ->nullable()
                  ->onDelete('cascade');
            $table->float('cost');
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
        Schema::dropIfExists('option_cost_options');
    }
}
