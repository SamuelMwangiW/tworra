<?php

declare(strict_types=1);

namespace App\Http\Controllers\Tweets;

use App\Events\TweetLikedEvent;
use App\Models\Tweet;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeTweet
{
    public function __invoke(Tweet $tweet, Request $request): RedirectResponse
    {
        /** @var array<string,array<int,string>> $liked */
        $liked = $tweet->likes()->toggle($request->user())['attached'];

        if (collect($liked)->count()) {
            /** @phpstan-ignore-next-line */
            TweetLikedEvent::dispatch($tweet, $request->user());
        }

        return back();
    }
}
