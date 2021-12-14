<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->bigInteger('feed_post_id')->unsigned()->nullable();
            $table->foreign('feed_post_id')->references('id')->on('feed_posts');
            $table->boolean('is_active')->default(0); 
            $table->boolean('is_delete')->default(0);
            $table->bigInteger('created_by');
            $table->bigInteger('updated_by');
            $table->bigInteger('deleted_by');
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
        Schema::dropIfExists('likes');
    }
}
