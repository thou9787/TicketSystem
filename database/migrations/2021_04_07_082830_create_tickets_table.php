<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('trainNo');
            $table->string('originStationName');
            $table->string('destinationStationName');
            $table->time('departureTime'); //Carbon()
            $table->time('arrivalTime');
            $table->string('fare');
            $table->integer('amount');
            $table->string('user_id');
            $table->string('trainDate');
            $table->string('ticketNo');
            $table->integer('paid')->default('0');
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
        Schema::dropIfExists('tickets');
    }
}
