<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::create('tweets', function (Blueprint $table) {
            $table->id();

            $table->text('message');
            $table->foreignId('user_id')->index();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tweets');
    }
};
