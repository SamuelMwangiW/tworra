<?php

declare(strict_types=1);

namespace App\Http\Controllers\Tweets;

use App\Models\Tweet;
use App\Models\User;

class ShowTweet
{
    public function __invoke(User $user, Tweet $tweet)
    {
        // TODO: Implement __invoke() method.
    }
}
