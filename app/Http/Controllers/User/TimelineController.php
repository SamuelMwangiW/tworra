<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\TimelineTweetsResource;
use App\Models\Tweet;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Inertia\Inertia;
use Inertia\Response;

class TimelineController extends Controller
{
    public function __invoke(Request $request): ResourceCollection|Response
    {
        $tweets = Tweet::query()
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
            component: 'Timeline',
            props: [
                'tweets' => TimelineTweetsResource::collection($tweets),
            ]
        );
    }
}
