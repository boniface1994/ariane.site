<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlightOpportunitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flight_opportunities', function (Blueprint $table) {
            $table->id();
            $table->integer('month');
            $table->integer('year');
            $table->string('name');
            $table->unsignedBigInteger('orbit_type_id');
            $table->foreign('orbit_type_id')
                ->references('id')
                ->on('orbit_types')
                ->onDelete('cascade');
            $table->float('altitude');
            $table->float('inclination');
            $table->integer('local_hour')->nullable();
            $table->integer('local_minute')->nullable();
            $table->boolean('ltan')->nullable();
            $table->boolean('ltdn')->nullable();
            $table->integer('position');
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
        Schema::dropIfExists('flight_opportunities');
    }
}
