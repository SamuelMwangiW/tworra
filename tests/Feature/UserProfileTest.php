<?php

declare(strict_types=1);

use App\Models\Tweet;
use App\Models\User;
use Inertia\Testing\AssertableInertia;

it('returns a 404 when username does not exist')
    ->asUser()
    ->get('does.not.exist')
    ->assertNotFound();

it('only authenticated users can view profile', function () {
    $user = User::factory()->create();

    $this->get("/{$user->username}")
        ->assertRedirect('login');
});

it('loads the user profile', function () {
    $user = User::factory()->create();

    $this
        ->actingAs($user)
        ->get("/{$user->username}")
        ->assertOk();
});

it('passes user tweets to their profile', function () {
    $user = User::factory()
        ->has(Tweet::factory()->count(10))
        ->create();

    $otherTweets = Tweet::factory()
        ->count(5)
        ->create();

    $this
        ->actingAs($user)
        ->get("/{$user->username}")
        ->assertInertia(
            fn (AssertableInertia $page) => $page
                ->has(
                    'user.data',
                    fn (AssertableInertia $userProp) => $userProp->hasAll([
                        'id',
                        'name',
                        'username',
                        'profilePhotoUrl',
                        'location',
                        'url',
                        'description',
                        'joined',
                        'tweets_count',
                        'followers_count',
                        'following_count',
                        'following',
                    ])
                )->has(
                    'tweets',
                    fn (AssertableInertia $tweetsObj) => $tweetsObj
                        ->hasAll(['data', 'links', 'meta'])
                        ->count('data', 10)
                        ->has(
                            'data',
                            fn (AssertableInertia $tweets) => $tweets
                                ->each(
                                    fn (AssertableInertia $tweet) => $tweet
                                        ->hasAll(['id', 'message', 'time', 'liked', 'likes', 'replies', 'retweets'])
                                        ->has(
                                            'user',
                                            fn (AssertableInertia $user) => $user->hasAll(
                                                ['name', 'username', 'profilePhotoUrl']
                                            )
                                        )
                                )
                        )
                )
                ->count('tweets.data', 10)
                ->where('user.data.id', $user->id)
        );
});
