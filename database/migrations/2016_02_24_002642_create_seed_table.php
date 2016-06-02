<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seeds', function (Blueprint $table) {
            $table->increments('id');
            $table->string('seed')->unique();
            $table->tinyInteger('local')->unsigned()->default(1);
            $table->tinyInteger('development')->unsigned()->default(1);
            $table->tinyInteger('stage')->unsigned()->default(0);
            $table->tinyInteger('production')->unsigned()->default(0);
            $table->timestamp('file_modified');
            $table->timestamp('last_run');
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
        Schema::drop('seeds');
    }
}
