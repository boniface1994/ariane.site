<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDemandeContactTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_request', function (Blueprint $table) {
            $table->id();
            $table->boolean('status');
            $table->string('message')->nullable();
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
        Schema::dropIfExists('contact_request');
    }
}
