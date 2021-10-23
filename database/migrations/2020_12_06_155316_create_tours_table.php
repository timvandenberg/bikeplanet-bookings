<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateToursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tours', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->string('season')->nullable();
            $table->integer('price')->nullable();
            $table->integer('max_bookings')->nullable();
            $table->integer('crew')->nullable();
            $table->integer('guides')->nullable();
            $table->string('start_location')->nullable();
            $table->date('start_date')->nullable();
            $table->string('end_location')->nullable();
            $table->date('end_date')->nullable();
            $table->string('booking_form')->nullable();
            $table->longText('invoice_text')->nullable();
            $table->string('referral_code')->nullable();
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
        Schema::dropIfExists('tours');
    }
}
