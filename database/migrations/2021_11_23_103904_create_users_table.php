<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('full_name');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->unique();
            $table->string('mobile')->nullable();
            $table->string('password')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->string('facebook_id')->nullable();
            $table->enum('visible_profile', ['yes', 'no'])->nullable();
            $table->string('orientation')->nullable();
            $table->string('relationship_status')->nullable();
            $table->string('looking_for')->nullable();
            $table->string('pets')->nullable();
            $table->string('meet_at')->nullable();
            $table->string('religious_views')->nullable();
            $table->string('children')->nullable();
            $table->enum('is_smoke', ['no', 'socially','occasionally','regularly','prefer not to say'])->nullable();
            $table->enum('is_drink', ['no', 'socially','occasionally','regularly','prefer not to say'])->nullable();
            $table->enum('is_canabis', ['no', 'socially'])->nullable();
            $table->string('about_you')->nullable();
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
        Schema::dropIfExists('users');
    }
}
