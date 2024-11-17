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
        Schema::create('books', function (Blueprint $table) {
            $table->bigIncrements('book_id');
            $table->string('book_title', 50);
            $table->text('description')->nullable();
            $table->string('thumbnail')->nullable(); // Corrected: Removed extra space
            $table->integer('quantity')->default(1);
            $table->decimal('price', 10, 2);
            $table->decimal('discount', 10, 2)->nullable();
            $table->boolean('discontinued')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->unsignedBigInteger('author_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('publish_id');
            $table->unsignedBigInteger('supplier_id');

            // Foreign keys
            $table->foreign('author_id')->references('author_id')->on('authors');
            $table->foreign('category_id')->references('category_id')->on('categories');
            $table->foreign('publish_id')->references('publish_id')->on('publishers');
            $table->foreign('supplier_id')->references('supplier_id')->on('suppliers');
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
        Schema::dropIfExists('books');
    }
};
