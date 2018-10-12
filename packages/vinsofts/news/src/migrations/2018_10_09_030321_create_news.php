<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('meta_title',60);
            $table->string('short_description');
            $table->string('meta_description');
            $table->string('slug');
            $table->text('content');
            $table->string('image');
            $table->boolean('status');
            $table->dateTime('created_at');
            $table->integer('author_id')->unsigned();
            $table->foreign('author_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('news_categories')->onDelete('cascade');
            
           //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news');
    }
}
