<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\User */
class UserProfileResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'username' => $this->username,
            'profilePhotoUrl' => $this->profile_photo_url,
            'location' => $this->location,
            'url' => $this->url,
            'description' => $this->description,
            'created' => str($this->created_at->diffForHumans())->trim(' ago'),
            'tweets_count' => $this->whenCounted('tweets'),
        ];
    }
}
