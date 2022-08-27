<?php

declare(strict_types=1);

use App\Models\User;
use App\Notifications\UserWasFollowed;
use Illuminate\Support\Facades\Notification;

it('follows a user', function () {
    $follower = User::factory()->create();
    $followee = User::factory()->create();

    $this->actingAs($follower)
        ->post("/{$followee->username}/follow")
        ->assertSessionHasNoErrors();

    expect($followee)->followers->toHaveCount(1);
});

it('notifies a user of a new follower', function () {
    $follower = User::factory()->create();
    $followee = User::factory()->create();
    Notification::fake();

    $this->actingAs($follower)
        ->post("/{$followee->username}/follow")
        ->assertSessionHasNoErrors();

    Notification::assertSentToTimes($followee, UserWasFollowed::class,1);
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

it('unfollows a user silently', function () {
    $follower = User::factory()->create();
    $followee = User::factory()->create();
    $followee->followers()->attach($follower->id);
    Notification::fake();

    $this->actingAs($follower)
        ->delete("/{$followee->username}/follow");

    Notification::assertNothingSent();
});
