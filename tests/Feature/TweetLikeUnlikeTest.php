<?php

declare(strict_types=1);

use App\Models\Tweet;
use App\Models\User;

test('a user can like a tweet', function () {
    $tweet = Tweet::factory()->create();
    $user = User::factory()->create();

    $this->actingAs($user)
        ->post(route('tweet.like', $tweet))
        ->assertSessionHasNoErrors();

    expect($tweet->likes)
        ->toHaveCount(1)
        ->first()->id->toBe($user->id)
        ->first()->email->toBe($user->email)
        ->first()->username->toBe($user->username)
        ->first()->name->toBe($user->name);
});

test('a user can toggle a tweet like', function () {
    $tweet = Tweet::factory()->create();
    $user = User::factory()->create();
    $tweet->likes()->attach($user->id);

    $this->actingAs($user)
        ->post(route('tweet.like', $tweet))
        ->assertSessionHasNoErrors();

    expect($tweet->likes)->toHaveCount(0);
});
