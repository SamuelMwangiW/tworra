<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('liked_tweets', function (Blueprint $table) {
            $table->id();

            $table->foreignId('tweet_id');
            $table->foreignId('user_id');

            $table->unique(['tweet_id','user_id']);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('liked_tweets');
    }
};
