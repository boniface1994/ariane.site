<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects',function(Blueprint $table){
            $table->string('local_time')->nullable();
            $table->boolean('ltan');
            $table->boolean('ltdn');
            $table->text('constraint')->nullable();
            $table->float('altitude_max');
            $table->float('altitude_min');
            $table->float('inclination_min');
            $table->float('inclination_max');
            $table->foreignId('orbit_type_id')->references('id')->on('orbit_types')
                  ->unsigned()
                  ->nullable()
                  ->onDelete('cascade');
            $table->foreignId('sc_interface_id')->references('id')->on('sc_interfaces')
                  ->unsigned()
                  ->nullable()
                  ->onDelete('cascade');
            $table->foreignId('propellant_type_id')->references('id')->on('propellant_type')
                  ->unsigned()
                  ->nullable()
                  ->onDelete('cascade');
            $table->foreignId('supplier_type_id')->references('id')->on('supplier_type')
                  ->unsigned()
                  ->nullable()
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
        //
    }
}
