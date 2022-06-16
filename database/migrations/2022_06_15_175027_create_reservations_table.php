<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            // Table_id
            $table->bigInteger('table_id')->unsigned();
            $table->foreign('table_id')
            ->references('id')->on('tables');
            // customer_id
            $table->bigInteger('customer_id')->unsigned();
            $table->foreign('customer_id')
            ->references('id')->on('customer');
            $table->dateTime('from_time');
            $table->dateTime('to_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
};
