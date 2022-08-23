<?php

declare(strict_types=1);

namespace App\Http\Controllers\Tweets;

use App\Events\TweetLikedEvent;
use App\Models\Tweet;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LikeTweet
{
    public function __invoke(Tweet $tweet, Request $request): RedirectResponse
    {
        $liked = $tweet->likes()->toggle($request->user())['attached'];

        if(collect($liked)->count()) {
            TweetLikedEvent::dispatch($tweet, $request->user());
        }

        return back();
    }
}
