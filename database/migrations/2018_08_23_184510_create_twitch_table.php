<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTwitchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('twitch', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->unique();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('identifiant');
            $table->string('player_username');
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
        Schema::dropIfExists('twitch');
    }
}
