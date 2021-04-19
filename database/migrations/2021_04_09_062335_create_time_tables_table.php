<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimeTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'time_tables',
            function (Blueprint $table) {
                $table->increments('id');
                $table->string('trainDate');
                $table->string('trainNo');
                $table->string('originStationId');
                $table->string('originStationName');
                $table->string('destinationStationId');
                $table->string('destinationStationName');
                $table->string('departureTime');
                $table->string('arrivalTime');
                $table->string('duration');
                $table->string('type');
                $table->integer('amount');
                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('time_tables');
    }
}
