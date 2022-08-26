<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\TimelineTweetsResource;
use App\Models\Retweet;
use App\Models\Tweet;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Inertia\Inertia;
use Inertia\Response;

class TimelineController extends Controller
{
    public function __invoke(Request $request): ResourceCollection|Response
    {
        /** @var User $user */
        $user = $request->user();

        $tweets = Tweet::query()
            ->latest()
            ->where(
                function (Builder $query) use ($user) {
                    $followings = $user->following()->pluck('users.id');

                    $query
                        ->where('user_id', $user->id)
                        ->orWhereIn('user_id', $followings)
                        ->orWhereIn(
                            column: 'id',
                            values:  Retweet::query()
                                ->whereIn('user_id', $followings)
                                ->pluck('tweet_id')
                        );
                }
            )->with(['user'])
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

        return Inertia::render(
            component: 'Timeline',
            props: [
                'tweets' => TimelineTweetsResource::collection($tweets),
            ]
        );
    }
}
