<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 1024);
            $table->string('origin_name', 1024);
            $table->string('slug')->unique()->index();
            $table->text('description')->nullable();
            $table->text('tags')->nullable();
            $table->string('image', 2048)->nullable();
            $table->enum('status', ['trailer', 'ongoing', 'completed']);
            $table->string('trailer_url', 2048)->nullable();
            $table->string('time')->nullable();
            $table->string('episode_current')->nullable();
            $table->string('episode_total')->nullable();
            $table->string('quality')->nullable()->default('HD');
            $table->string('language')->nullable()->default('Vietsub');

            $table->integer('year')->index()->nullable();
            $table->boolean('is_copyright')->default(false);

            $table->integer('view')->default(0);
            $table->integer('view_day')->default(0);
            $table->integer('view_week')->default(0);
            $table->integer('view_month')->default(0);

            $table->unsignedBigInteger('country_id')->nullable()->index();
            $table->foreign('country_id')->references('id')->on('countries')->cascadeOnDelete();

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
        Schema::dropIfExists('movies');
    }
}