<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->default(0);
            $table->integer('tour_id')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('room')->nullable();
            $table->string('hotel')->nullable();
            $table->integer('price')->nullable();
            $table->boolean('documents')->default(0);
            $table->boolean('completed')->default(0);
            $table->boolean('active')->default(1);
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
        Schema::dropIfExists('bookings');
    }
}
