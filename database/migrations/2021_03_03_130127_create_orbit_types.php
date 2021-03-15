<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrbitTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orbit_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('explication');
            $table->boolean('orbit_leo')->nullable();
            $table->boolean('orbit_sso')->nullable();
            $table->boolean('tarif_leo')->nullable();
            $table->boolean('tarif_gto')->nullable();
            $table->integer('position');
            $table->timestamps();
        });

        Schema::create('orbit_type_parameter', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->float('start');
            $table->float('end');
            $table->float('jump');
            $table->timestamps();
            $table->unsignedBigInteger('orbit_type_id');
            $table->foreign('orbit_type_id')
                ->references('id')
                ->on('orbit_types')
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
        Schema::dropIfExists('orbit_type_parameter');
        Schema::dropIfExists('orbit_types');
    }
}
