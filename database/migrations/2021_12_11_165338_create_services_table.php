<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sub_category_id')->nullable();
            $table->foreign('sub_category_id')->references('id')
                ->on('sub_categories')->onDelete('cascade');
            $table->string('name')->nullable();
            $table->string('image')->nullable();
            $table->string('price_type')->nullable();
            $table->string('orders')->nullable();
            $table->string('old_price')->nullable();
            $table->text('description')->nullable();
            $table->string('price')->nullable();
            $table->string('city')->nullable();
            $table->string('rate')->nullable();
            $table->integer('trending')->default(0);
            $table->integer('enable')->default(1);
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
        Schema::dropIfExists('services');
    }
}
