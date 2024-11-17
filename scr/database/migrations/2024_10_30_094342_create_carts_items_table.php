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
        Schema::create('carts_items', function (Blueprint $table) {
            $table->bigIncrements('cart_item_id');
            $table->unsignedBigInteger('cart_id');
            $table->unsignedBigInteger('book_id');
            $table->integer('amount')->default(1)->check('amount > 0');
            $table->timestamps();
        
            $table->foreign('cart_id')->references('cart_id')->on('carts');
            $table->foreign('book_id')->references('book_id')->on('books');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carts_items');
    }
};
