<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTravelersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('travelers', function (Blueprint $table) {
            $table->id();
            $table->integer('booking_id')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('street')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('town')->nullable();
            $table->string('country')->nullable();
            $table->string('bike')->nullable();
            $table->string('height')->nullable();
            $table->string('cabin')->nullable();
            $table->string('diet')->nullable();
            $table->string('diet_remarks')->nullable();
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
        Schema::dropIfExists('traveler');
    }
}
