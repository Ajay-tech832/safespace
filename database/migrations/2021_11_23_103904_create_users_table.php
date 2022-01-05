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
            $table->string('full_name',55);
            $table->string('first_name',25)->nullable();
            $table->string('last_name',25)->nullable();
            $table->string('email',100)->unique();
            $table->string('mobile',15)->nullable();
            $table->string('otp',100)->nullable();
            $table->enum('isVerified', ['1', '0'])->nullable();
            $table->string('password',255)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->text('facebook_id')->nullable();
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
            $table->string('about')->nullable();
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
