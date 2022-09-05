<?php

declare(strict_types=1);

namespace App\Http\Controllers\Tweets;

use App\Models\Tweet;
use App\Models\User;
use Illuminate\Http\RedirectResponse;

class ShowTweet
{
    public function __invoke(User $user, Tweet $tweet): RedirectResponse
    {
        return redirect('/');
//        return Inertia::render(
//            component: 'Tweet',
//            props: ['tweet' => $tweet]
//        );
    }
}
