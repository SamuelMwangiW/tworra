<?php

namespace App\Listeners;

use App\Events\TweetRetweetedEvent;

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
