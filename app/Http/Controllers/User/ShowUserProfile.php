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
                'likes',
                'retweets',
                'likes as liked' => fn (Builder $q) => $q->where('user_id', auth()->id()),
                'retweets as retweeted' => fn (Builder $q) => $q->where('user_id', auth()->id()),
            ])
            ->withCasts(['liked' => 'boolean','retweeted' => 'boolean'])
            ->simplePaginate();

        if ($request->wantsJson()) {
            return TimelineTweetsResource::collection($tweets);
        }

        $user
            ->loadCount([
                'followers as is_following' => fn (Builder $query) => $query->where('follower_id', auth()->id()),
            ])->loadCount(['tweets', 'followers', 'following'])
            ->withCasts(['is_following'=>'boolean']);

        return Inertia::render(
            component: 'User/UserProfile',
            props: [
                'user' => UserProfileResource::make($user),
                'tweets' => TimelineTweetsResource::collection($tweets),
            ]
        );
    }
}
