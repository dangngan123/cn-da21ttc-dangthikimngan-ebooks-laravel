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
        Schema::create('sliders', function (Blueprint $table) {
            $table->bigIncrements('slider_id');
            $table->string('slider_name', 100);
            $table->text('description')->nullable();
            $table->string('thumbnail', 255)->nullable();
            $table->integer('display_order')->default(0);
            $table->enum('status', ['Đang hoạt động', 'Không hoạt động'])->default('Đang hoạt động');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sliders');
    }
};
