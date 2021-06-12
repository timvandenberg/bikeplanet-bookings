<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingPersonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_persons', function (Blueprint $table) {
            $table->id();
            $table->integer('booking_id')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('bike')->nullable();
            $table->string('food')->nullable();
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
        Schema::dropIfExists('booking_persons');
    }
}
