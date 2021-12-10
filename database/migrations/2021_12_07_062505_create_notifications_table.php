<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->text('text')->nullable();
            $table->enum('type', ['text', 'audio','files'])->nullable();
            $table->bigInteger('type_id');
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->boolean('is_read')->nullable()->default(0);
            $table->datetime('date_time')->nullable();
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
        Schema::dropIfExists('notifications');
    }
}
