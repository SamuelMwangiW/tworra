<?php

declare(strict_types=1);

namespace App\Http\Controllers\Tweets;

use App\Models\Tweet;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LikeTweet
{
    public function __invoke(Tweet $tweet, Request $request): RedirectResponse
    {
        $tweet->likes()->toggle($request->user());

        return back();
    }
}
