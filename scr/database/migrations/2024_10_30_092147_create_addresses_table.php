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
        Schema::create('addresses', function (Blueprint $table) {
            $table->bigIncrements('address_id');  // Khóa chính, tự động tăng
            $table->unsignedBigInteger('user_id'); 
            $table->string('addressLine1');
            $table->string('addressLine2')->nullable();
            $table->string('city', 100);
            $table->string('province', 100)->nullable();
            $table->string('country', 100);
            $table->enum('address_type', ['Nhà riêng', 'Văn phòng'])->default('Nhà riêng');
            $table->timestamps();
            
            $table->foreign('user_id')->references('user_id')->on('users'); // Ràng buộc khóa ngoại 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
};
