<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\TimelineTweetsResource;
use App\Http\Resources\UserProfileResource;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Inertia\Inertia;
use Inertia\Response;

class ShowUserProfile extends Controller
{
    public function __invoke(User $user, Request $request): ResourceCollection|Response
    {
        $tweets = $user->tweets()
            ->latest()
            ->with(['user'])
            ->withCount([
                'likes as liked' => fn (Builder $q) => $q->where('user_id', auth()->id())
            ])
            ->withCount('likes')
            ->simplePaginate();

        if ($request->wantsJson()) {
            return TimelineTweetsResource::collection($tweets);
        }

        return Inertia::render(
            component: 'Tweets/UserProfile',
            props: [
                'user' => UserProfileResource::make($user->loadCount(['tweets'])),
                'tweets' => TimelineTweetsResource::collection($tweets)
            ]
        );
    }
}
