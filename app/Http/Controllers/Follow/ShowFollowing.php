<?php

declare(strict_types=1);

namespace App\Http\Controllers\Follow;

use App\Http\Resources\TimelineTweetUserResource;
use App\Http\Resources\UserFollowSummaryResource;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Inertia\Inertia;

class ShowFollowing
{
    public function __invoke(User $user)
    {
        $following = $user->following()
            ->withCount([
                'followers as followings' => fn (Builder $query) => $query
                    ->where('follower_id', auth()->id()),
            ])
            ->withCasts(['followings' => 'boolean'])
            ->simplePaginate();

        return Inertia::render(
            component: 'User/Following',
            props: [
                'user' => TimelineTweetUserResource::make($user),
                'following' => UserFollowSummaryResource::collection($following)
            ]
        );
    }
}
