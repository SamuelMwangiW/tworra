<?php

declare(strict_types=1);

use App\Http\Controllers\Tweets\PostTweet;
use App\Http\Controllers\User\TimelineController;
use Illuminate\Support\Facades\Route;

Route::get('/', TimelineController::class)->name('timeline');
Route::post('/tweets', PostTweet::class)->name('tweets.create');
