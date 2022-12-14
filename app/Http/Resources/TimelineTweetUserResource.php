<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\User */
class TimelineTweetUserResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array<string,string>
     */
    public function toArray($request): array
    {
        return [
            'name' => $this->name,
            'username' => $this->username,
            'profilePhotoUrl' => $this->profile_photo_url,
        ];
    }
}
