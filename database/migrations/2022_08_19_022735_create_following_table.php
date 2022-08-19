<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('following', function (Blueprint $table) {
            $table->id();

            $table->foreignId('follower_id')->index();
            $table->foreignId('followed_id')->index();

            $table->index('follower_id','followed_id');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('following');
    }
};
