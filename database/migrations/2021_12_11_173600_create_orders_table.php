<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // status pending
        // status accepted
        // status completed
        // status canceled
        // status removed
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')
            ->on('users')->onDelete('cascade');
            $table->string('status')->default('pending');
            $table->date('date')->nullable();
            $table->time('time')->nullable();
            $table->unsignedBigInteger('selected_address')->nullable();
            $table->foreign('selected_address')->references('id')->on('addresses')->onDelete('cascade');
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
        Schema::dropIfExists('orders');
    }
}
