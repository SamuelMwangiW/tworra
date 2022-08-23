<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::create('retweets', function (Blueprint $table) {
            $table->id();

            $table->foreignId('tweet_id')->index();
            $table->foreignId('user_id')->index();

            $table->unique(['tweet_id','user_id']);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('retweets');
    }
};
