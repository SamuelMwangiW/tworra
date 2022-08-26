<?php

declare(strict_types=1);

use App\Models\Tweet;
use App\Models\User;
use Inertia\Testing\AssertableInertia;

test('users must be logged in to view the timeline')
    ->get('/')
    ->assertRedirect('login');

test('users can view the timeline', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get('/')
        ->assertOk()
        ->assertInertia(
            fn (AssertableInertia $page) => $page->component('Timeline')
        );
});

test('timeline contains users tweets', function () {
    $user = User::factory()
        ->has(Tweet::factory()->count(5))
        ->create();

    $this->actingAs($user)
        ->get('/')
        ->assertOk()
        ->assertInertia(
            fn (AssertableInertia $page) => $page
                ->has(
                    'tweets.data',
                    fn (AssertableInertia $data) => $data
                        ->count(5)
                        ->each(
                            fn (AssertableInertia $tweet) => $tweet
                                ->hasAll(
                                    ['id', 'message', 'time', 'likes', 'replies', 'liked', 'retweets', 'retweeted']
                                )
                                ->has(
                                    'user',
                                    fn (AssertableInertia $owner) => $owner
                                        ->where('name', $user->name)
                                        ->where('username', $user->username)
                                        ->where('profilePhotoUrl', $user->profile_photo_url)
                                )
                        )
                )
        );
});

test('timeline contains following tweets', function () {
    $user = User::factory()
        ->has(Tweet::factory()->count(3))
        ->create();

    $followedUserA = User::factory()
        ->has(Tweet::factory()->count(3))
        ->create();

    $followedUserB = User::factory()
        ->has(Tweet::factory()->count(3))
        ->create();

    $user->following()->attach([$followedUserA->id, $followedUserB->id]);

    $this->actingAs($user)
        ->get('/')
        ->assertOk()
        ->assertInertia(
            fn (AssertableInertia $page) => $page
                ->has(
                    'tweets.data',
                    fn (AssertableInertia $data) => $data
                        ->count(9)
                        ->each(
                            fn (AssertableInertia $tweet) => $tweet->hasAll([
                                'id',
                                'message',
                                'time',
                                'likes',
                                'replies',
                                'liked',
                                'retweets',
                                'retweeted',
                                'user',
                            ])
                        )
                )
        );
});

test('timeline does not contain tweets from users not followed', function () {
    $user = User::factory()
        ->has(Tweet::factory()->count(1))
        ->create();

    $followedUserA = User::factory()
        ->has(Tweet::factory()->count(3))
        ->create();

    $notFollowedUser = User::factory()
        ->has(Tweet::factory()->count(6))
        ->create();

    $user->following()->attach([$followedUserA->id]);

    $this->actingAs($user)
        ->get('/')
        ->assertInertia(
            fn (AssertableInertia $page) => $page->has(
                'tweets.data',
                fn (AssertableInertia $data) => $data->count(4)->etc()
            )
        );
});
