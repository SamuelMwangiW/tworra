<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\TimelineTweetsResource;
use App\Http\Resources\UserProfileResource;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ShowUserProfile extends Controller
{
    public function __invoke(User $user, Request $request)
    {
        $user->loadCount(['tweets']);

        $tweets = $user->tweets()
            ->latest()
            ->with(['user'])
            ->withCount('likes')
            ->simplePaginate();

        return Inertia::render(
            component: 'Tweets/UserProfile',
            props: [
                'user' => UserProfileResource::make($user),
                'tweets' => TimelineTweetsResource::collection($tweets)
            ]
        );
    }
}
