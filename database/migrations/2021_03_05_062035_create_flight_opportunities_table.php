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
            $table->string('name');
            $table->string('month');
            $table->integer('year');
            $table->foreignId('orbite_type_id')->references('id')->on('orbite_types')
                  ->unsigned()
                  ->nullable()
                  ->onDelete('cascade');
            $table->float('altitude');
            $table->float('inclinaison');
            $table->boolean('ltan');
            $table->boolean('ltdn');
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
