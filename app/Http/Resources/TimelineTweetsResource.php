<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Tweet */
class TimelineTweetsResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array<string,mixed>
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'message' => $this->message,
            'time' => $this->created_at?->diffForHumans(),
            'liked' => $this?->liked ?? false,
            'retweeted' => $this?->retweeted ?? false,
            /** @phpstan-ignore-next-line  */
            'likes' => $this->whenCounted(relationship: 'likes', value: $this->likes_count, default: 0),
            'replies' => 0,
            /** @phpstan-ignore-next-line  */
            'retweets' => $this->whenCounted(relationship: 'retweets', value: $this->retweets_count, default: 0),

            'user' => TimelineTweetUserResource::make(
                $this->whenLoaded('user')
            ),
        ];
    }
}
