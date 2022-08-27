<?php

declare(strict_types=1);

use App\Events\TweetRetweetedEvent;
use App\Models\Tweet;
use App\Models\User;
use App\Notifications\TweetWasRetweeted;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;

it('tweets a tweet', function () {
    $user = User::factory()->create();
    $tweet = Tweet::factory()->create();

    $user->retweet($tweet);

    expect($tweet)
        ->retweets->toHaveCount(1)
        ->retweets->first()->tweet->is($tweet)->toBeTrue()
        ->retweets->first()->user->is($user)->toBeTrue()
        ->and($user)->retweets->toHaveCount(1);
});

test('a user can retweet a tweet', function () {
    $tweet = Tweet::factory()->create();

    asUser()
        ->post(route('tweet.retweet', $tweet))
        ->assertSessionHasNoErrors()
        ->assertRedirect();

    expect($tweet)
        ->retweets->toHaveCount(1)
        ->retweets->first()->tweet->is($tweet)->toBeTrue();
});

it('dispatches a TweetRetweeted event', function () {
    Event::fake([TweetRetweetedEvent::class]);
    $tweet = Tweet::factory()->create();

    asUser()
        ->post(route('tweet.retweet', $tweet))
        ->assertSessionHasNoErrors()
        ->assertRedirect();

    Event::assertDispatched(
        event: TweetRetweetedEvent::class,
        callback:  fn (TweetRetweetedEvent $event) => $event->tweet->is($tweet)
    );
});

it('sends a TweetWasRetweeted notification', function () {
    Notification::fake();
    \Illuminate\Support\Facades\Bus::fake();
    $tweet = Tweet::factory()->create();

    $user = User::factory()->create();
    TweetRetweetedEvent::dispatch($tweet, $user);

    Notification::assertSentToTimes($tweet->user, TweetWasRetweeted::class, 1);
})->skip();

it('toggles a retweet', function () {
    $tweet = Tweet::factory()->create();
    $user = User::factory()->create();
    $user->retweet($tweet);

    asUser($user)
        ->post(route('tweet.retweet', $tweet))
        ->assertSessionHasNoErrors()
        ->assertRedirect();

    expect($tweet->fresh())
        ->retweets->toHaveCount(0);
});
