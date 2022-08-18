<?php

declare(strict_types=1);

namespace App\Http\Controllers\Tweets;

use App\Http\Requests\PostTweetRequest;
use Illuminate\Http\RedirectResponse;

class PostTweet
{
    public function __invoke(PostTweetRequest $request): RedirectResponse
    {
        $request->user()->tweets()->create([
            'message' => $request->input('message')
        ]);

        return back();
    }
}
