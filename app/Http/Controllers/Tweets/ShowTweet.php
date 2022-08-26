<?php

declare(strict_types=1);

namespace App\Http\Controllers\Tweets;

use App\Models\Tweet;
use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;

class ShowTweet
{
    public function __invoke(User $user, Tweet $tweet): Response
    {
        return Inertia::render(
            component: 'Tweet',
            props: ['tweet' => $tweet]
        );
    }
}
