<?php

declare(strict_types=1);

namespace App\Http\Controllers\Follow;

use App\Http\Resources\TimelineTweetUserResource;
use App\Http\Resources\UserFollowSummaryResource;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ShowFollowers
{
    public function __invoke(User $user, Request $request): Response
    {
        $followers = $user->followers()
            ->withCount([
                'followers as followings' => fn (Builder $query) => $query->where('follower_id', auth()->id()),
            ])
            ->withCasts(['followings' => 'boolean'])
            ->simplePaginate();

        return Inertia::render(
            component: 'User/Followers',
            props: [
                'user' => TimelineTweetUserResource::make($user),
                'followers' => UserFollowSummaryResource::collection($followers),
            ]
        );
    }
}
