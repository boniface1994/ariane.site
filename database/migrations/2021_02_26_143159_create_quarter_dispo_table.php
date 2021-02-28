<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuarterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quarters_availables', function (Blueprint $table) {
            $table->id();
            $table->string('month')->nullable();
            $table->integer('year');
            $table->foreignId('user_id')->references('id')->on('users')
                  ->unsigned()
                  ->nullable()
                  ->onDelete('cascade');
            $table->foreignId('quarter_id')->references('id')->on('quarters')
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
        Schema::dropIfExists('quarters_availables');
    }
}
