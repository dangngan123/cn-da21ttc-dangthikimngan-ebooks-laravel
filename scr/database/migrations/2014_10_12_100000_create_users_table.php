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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('user_id');
            $table->string('user_name', 50)->unique();
            $table->string('password',255);
            $table->string('email', 255)->unique();
            $table->string('phone', 20)->nullable();
            $table->unsignedBigInteger('role_id');
            $table->enum('status', ['Đang hoạt động', 'Không hoạt động'])->default('Đang hoạt động');
            $table->enum('points_level', ['Đồng', 'Bạc', 'Vàng', 'Kim cương'])->default('Đồng');
            $table->rememberToken();
            $table->timestamps();

            // Foreign key constraint
    $table->foreign('role_id')->references('role_id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
