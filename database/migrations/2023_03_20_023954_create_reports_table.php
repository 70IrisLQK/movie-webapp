<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('movie_id')->index()->nullable();
            $table->unsignedBigInteger('episode_id')->index()->nullable();

            $table->string('server_name', 101)->nullable();
            $table->string('movie_name', 500)->nullable();
            $table->string('error_url', 255)->nullable();
            $table->text('content')->nullable();
            $table->string('username', 100)->nullable();
            $table->text('issues')->nullable();
            $table->foreign('movie_id')->references('id')->on('movies')->onDelete('cascade');
            $table->foreign('episode_id')->references('id')->on('episodes')->onDelete('cascade');

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
        Schema::dropIfExists('reports');
    }
}