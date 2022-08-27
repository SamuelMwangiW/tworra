<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\TweetRetweetedEvent;
use App\Notifications\TweetWasRetweeted;

class HandleToggleRetweet
{
    public function handle(TweetRetweetedEvent $event): void
    {
        if ($event->user->hasRetweeted(tweet: $event->tweet)) {
            $event->user->undoRetweet(tweet: $event->tweet);

            return;
        }

        $event->user->retweet(tweet: $event->tweet);
    }
}
