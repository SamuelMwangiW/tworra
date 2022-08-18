<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostTweetRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'message' => ['bail', 'required', 'string', 'min:3', 'max:255'],
        ];
    }
}
