<?php

use App\Models\Tweet;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;

it('posts tweets', function (string $tweet) {
    $user = User::factory()->create();

    actingAs($user)
        ->post(uri: route('tweets.create'), data: ['message' => $tweet])
        ->assertRedirect()
        ->assertSessionHasNoErrors();

    assertDatabaseHas(Tweet::class, ['user_id' => $user->id, 'message' => $tweet]);
})->with('tweets');
