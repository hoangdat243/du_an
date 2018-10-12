<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTags extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_tags', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('news_id')->unsigned();
            $table->foreign('news_id')->references('id')->on('news')->onDelete('cascade');
            $table->integer('tags_id')->unsigned();
            $table->foreign('tags_id')->references('id')->on('tags')->onDelete('cascade');
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
        Schema::dropIfExists('news_tags');
    }
}
