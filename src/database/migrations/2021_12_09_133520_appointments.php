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
            $table->integer('appointment_id')->autoIncrement();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('contact_id')->unsigned();
            $table->string('appointment_address');
            $table->string('post_code');

            $table->dateTime('appointment_date');
            $table->integer('distance');
            $table->timestamp('estimated_time_out_of_office');
            $table->timestamp('available_time_at_the_office');
            $table->timestamps();

            //$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            //$table->foreign('contact_id')->references('id')->on('contacts')->onDelete('cascade');
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
