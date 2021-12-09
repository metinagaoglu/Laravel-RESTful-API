<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Appointments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id('appointment_id');
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('contact_id')->unsigned();
            $table->string('appointment_address');
            $table->dateTime('appointment_date');

            $table->integer('distance');
            $table->dateTime('estimated_time_out_of_office');
            $table->dateTime('available_time_at_the_office');
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
        Schema::drop('appointments');
    }
}
