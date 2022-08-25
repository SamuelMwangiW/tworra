<?php

declare(strict_types=1);

namespace App\Http\Controllers\Tweets;

use App\Events\TweetRetweetedEvent;
use App\Models\Tweet;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ReTweetController
{
    public function __invoke(Tweet $tweet, Request $request): RedirectResponse
    {
        TweetRetweetedEvent::dispatch($tweet, $request->user());

        return back();
    }
}
