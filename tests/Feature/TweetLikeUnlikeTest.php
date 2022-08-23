<?php

declare(strict_types=1);

use App\Events\TweetLikedEvent;
use App\Models\Tweet;
use App\Models\User;
use Illuminate\Support\Facades\Event;

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

test('liking a tweet dispatches TweetLiked event', function () {
    Event::fake([TweetLikedEvent::class]);
    $tweet = Tweet::factory()->create();
    $user = User::factory()->create();

    $this->actingAs($user)
        ->post(route('tweet.like', $tweet))
        ->assertSessionHasNoErrors();

    Event::assertDispatched(
        event: TweetLikedEvent::class,
        callback: fn (TweetLikedEvent $event) => expect($event)
            ->user->toBe($user)
            ->tweet->id->toBe($tweet->id)
    );
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

test('unliking a tweet does not dispatch a TweetLiked event', function () {
    Event::fake([TweetLikedEvent::class]);
    $tweet = Tweet::factory()->create();
    $user = User::factory()->create();
    $tweet->likes()->attach($user->id);

    $this->actingAs($user)
        ->post(route('tweet.like', $tweet))
        ->assertSessionHasNoErrors();

    Event::assertNotDispatched(event: TweetLikedEvent::class);
});
