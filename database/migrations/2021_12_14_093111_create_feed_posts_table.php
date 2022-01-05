<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feed_posts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->bigInteger('feed_id')->unsigned()->nullable();
            $table->foreign('feed_id')->references('id')->on('feeds');
            $table->string('heading',255)->nullable();
            $table->string('sub_heading',255)->nullable();
            $table->string('about',300)->nullable();
            $table->string('description_heading',255)->nullable();
            $table->text('description')->nullable();
            $table->text('image_path')->nullable();
            $table->bigInteger('like')->unsigned()->nullable();
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
        Schema::dropIfExists('feed_posts');
    }
}
