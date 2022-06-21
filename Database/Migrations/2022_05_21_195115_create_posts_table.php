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
            $table->id();                                                       // ID of the Post
            $table->string      ('post_title');                         // Title of the Post
            $table->text        ('post_content');                       // Content of Blogpost
            $table->string      ('post_content_short')  ->nullable();   // Shortage of the Blogpost
            $table->integer     ('post_category_id')    ->nullable();   // Category of the Blogpost @todo create categories
            $table->string      ('post_image')          ->nullable();   // FrontImage of these Blogpost
            $table->boolean     ('post_status')         ->default(false);   // Status of Blogpost / false=inactive true=active
            $table->timestamp   ('post_created_at')     ->nullable();   // Date of the streetdate of the blogpost
            $table->unsignedBigInteger('post_author')   ->nullable();   // Author of these blogpost

            $table->timestamps();

            $table->foreign('post_author')->references('id')->on('users'); // Connect Author and post_author
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
