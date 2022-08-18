<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

/** @mixin \App\Models\Tweet */
class TimelineTweetsResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'message' => $this->message,
            'time' => $this->created_at->diffForHumans(),
            'liked' => Arr::random([true,false]),
            'likes' => $this->whenCounted(relationship: 'likes', default: 0),
            'replies' => 2,
            'retweets' => 2,

            'user' => TimelineTweetUserResource::make(
                $this->whenLoaded('user')
            ),
        ];
    }
}
