<?php

declare(strict_types=1);

use App\Models\User;

it('follows a user', function () {
    $follower = User::factory()->create();
    $followee = User::factory()->create();

    $this->actingAs($follower)
        ->post("/{$followee->username}/follow")
        ->assertSessionHasNoErrors();

    expect($followee)->followers->toHaveCount(1);
});

it('unfollows a user', function () {
    $follower = User::factory()->create();
    $followee = User::factory()->create();
    $followee->followers()->attach($follower->id);

    $this->actingAs($follower)
        ->delete("/{$followee->username}/follow")
        ->assertSessionHasNoErrors();

    expect($followee)->followers->toHaveCount(0);
});
