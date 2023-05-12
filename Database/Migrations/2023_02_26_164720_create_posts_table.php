<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('author_id');
            //$table->unsignedBigInteger('book_id')->nullable();
            //$table->unsignedBigInteger('category_id')->nullable();
            $table->text('title');
            $table->text('content')->nullable();
            $table->text('content_short')->nullable();
            $table->boolean('is_launched')->default(null);
            $table->date('launch_date')->nullable()->default(null);
            //$table->text('cover_image_path')->nullable();

            $table->timestamps();

            $table->foreign('author_id')->references('id')->on('users');
            //$table->foreign('book_id')->references('id')->on('books');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
