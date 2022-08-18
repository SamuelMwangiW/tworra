<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

/** @mixin \App\Models\User */
class UserProfileResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array<string,mixed>
     */
    public function toArray($request): array
    {
        $createdAt = $this->created_at?->diffForHumans() ?? '';

        return [
            'id' => $this->id,
            'name' => $this->name,
            'username' => $this->username,
            'profilePhotoUrl' => $this->profile_photo_url,
            'location' => $this->location,
            'url' => $this->url,
            'description' => $this->description,
            'created' => Str::of($createdAt)->trim(' ago')->value(),
            'tweets_count' => $this->whenCounted('tweets'),
        ];
    }
}
