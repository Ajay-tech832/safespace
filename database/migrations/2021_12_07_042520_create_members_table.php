<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->enum('is_visible_profile', ['yes', 'no'])->nullable();
            $table->enum('orientation', ['pansexual', 'transgender','lesbian'])->nullable();
            $table->enum('relationship_status', ['single', 'commited','enganged','married','divorce','widowered','prefer not to say'])->nullable();
            $table->enum('looking_for', ['chat', 'dates','friends','network','relationship'])->nullable();
            $table->enum('is_pets', ['yes', 'no'])->nullable();
            $table->enum('meet_at', ['bar', 'coffee shop','restuarant'])->nullable();
            $table->enum('religious_views', ['practicing/orthodox', 'questioning','spiritual'])->nullable();
            $table->enum('children', ['want someday', 'dont want','have and want more','have and dont want','more not sure yet'])->nullable();
            $table->enum('is_smoke', ['no', 'socially','occasionally','regularly','prefer not to say'])->nullable();
            $table->enum('is_drink', ['no', 'socially','occasionally','regularly','prefer not to say'])->nullable();
            $table->enum('is_canabis', ['no', 'socially'])->nullable();
            $table->text('about')->nullable();
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
        Schema::dropIfExists('members');
    }
}
