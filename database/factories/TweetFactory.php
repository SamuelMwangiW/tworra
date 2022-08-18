<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Tweet;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TweetFactory extends Factory
{
    protected $model = Tweet::class;

    public function definition(): array
    {
        return [
            'message' => $this->faker->sentences(asText: true),
            'user_id' => User::factory(),
        ];
    }
}
