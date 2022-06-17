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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            // reservation_id
            $table->bigInteger('reservation_id')->unsigned();
            $table->foreign('reservation_id')
            ->references('id')->on('reservations');
            // Table_id
            $table->bigInteger('table_id')->unsigned();
            $table->foreign('table_id')
            ->references('id')->on('tables');
            // customer_id
            $table->bigInteger('customer_id')->unsigned();
            $table->foreign('customer_id')
            ->references('id')->on('customer');
            $table->bigInteger('waiter_id')->unsigned();
            $table->integer('total');
            $table->boolean('paid')->default(false);
            $table->timestamp('date')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
