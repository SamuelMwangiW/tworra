<?php

declare(strict_types=1);

namespace App\Providers;

use App\Events\TweetLikedEvent;
use App\Events\TweetRetweetedEvent;
use App\Listeners\HandleToggleRetweet;
use App\Listeners\SendTweetRetweetedNotification;
use App\Listeners\SendTweetWasLikedNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        TweetRetweetedEvent::class => [
            HandleToggleRetweet::class,
            SendTweetRetweetedNotification::class,
        ],
        TweetLikedEvent::class => [
            SendTweetWasLikedNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
