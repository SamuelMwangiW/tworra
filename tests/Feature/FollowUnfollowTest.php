<?php

use App\Models\User;

it('follows a user', function () {
    $follower = User::factory()->create();
    $followee = User::factory()->create();

    $this->actingAs($follower)
        ->post("/{$followee->username}/follow")
        ->assertSessionHasNoErrors();

    expect($followee)->followers->toHaveCount(1);
});
