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
        Schema::create('vouchers', function (Blueprint $table) {
            $table->bigIncrements('voucher_id');
            $table->string('voucher_name', 100);
            $table->unsignedBigInteger('book_id');
            $table->decimal('discount', 10, 2);
            $table->string('description', 255)->nullable();
            $table->decimal('minimum_order_value', 10, 2)->default(0.00); //số tiền tối thiểu cần thiết để áp phiếu giảm giá
            $table->integer('usage_limit')->default(1); //giới hạn số lần sử dụng
            $table->enum('status', ['Đang hoạt động', 'Không hoạt động'])->default('Đang hoạt động');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->timestamps();
        
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
        Schema::dropIfExists('vouchers');
    }
};
