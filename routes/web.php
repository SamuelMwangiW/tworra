<?php

declare(strict_types=1);

use App\Http\Controllers\Follow\ShowFollowers;
use App\Http\Controllers\Follow\ShowFollowing;
use App\Http\Controllers\Follow\CreateController;
use App\Http\Controllers\Follow\DestroyController;
use App\Http\Controllers\Tweets\LikeTweet;
use App\Http\Controllers\Tweets\PostTweet;
use App\Http\Controllers\User\ShowUserProfile;
use App\Http\Controllers\User\TimelineController;
use Illuminate\Support\Facades\Route;

Route::get('/', TimelineController::class)->name('timeline');
Route::post('/tweets', PostTweet::class)->name('tweets.create');
Route::post('/tweets/{tweet}/like', LikeTweet::class)->name('tweet.like');
Route::get('/{user:username}/following', ShowFollowing::class)->name('following');
Route::get('/{user:username}/followers', ShowFollowers::class)->name('followers');
Route::get('/{user:username}/mutual-followers', ShowFollowers::class)->name('followers.mutual');
Route::post('/{user:username}/follow', CreateController::class)->name('follow.create');
Route::delete('/{user:username}/follow', DestroyController::class)->name('follow.destroy');

// Always keep this as the last route
Route::get('/{user:username}', ShowUserProfile::class)->name('show-user-profile');
