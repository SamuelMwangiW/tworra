<?php

declare(strict_types=1);

namespace App\Http\Controllers\Tweets;

use App\Http\Requests\PostTweetRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;

class PostTweet
{
    public function __invoke(PostTweetRequest $request): RedirectResponse
    {
        /** @var User $user */
        $user = $request->user();

        $user->tweets()->create([
            'message' => $request->input('message')
        ]);

        return back();
    }
}
