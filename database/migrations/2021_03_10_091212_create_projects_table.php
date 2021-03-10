<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('step_1')->nullable();
            $table->boolean('step_2')->nullable();
            $table->boolean('step_3')->nullable();
            $table->boolean('step_4')->nullable();
            $table->boolean('received')->nullable();
            $table->boolean('valid')->nullable();
            $table->text('contact_ariane')->nullable();
            $table->foreignId('customer_id')->references('id')->on('customers')
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
        Schema::dropIfExists('projects');
    }
}
