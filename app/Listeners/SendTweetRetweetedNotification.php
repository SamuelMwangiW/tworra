<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\TweetRetweetedEvent;
use App\Notifications\TweetWasRetweeted;
use Illuminate\Support\Facades\Cache;

class SendTweetRetweetedNotification
{
    public function handle(TweetRetweetedEvent $event): void
    {
        // Avoid multiple notifications for the same tweet
        $lock = Cache::lock($this->lockKey($event), 86400);

        if (! $lock->get()) {
            return;
        }

        if ($event->user->hasRetweeted(tweet: $event->tweet)) {
            $event->tweet->load(['user']);

            /** @phpstan-ignore-next-line */
            $event->tweet->user->notify(new TweetWasRetweeted($event->tweet, $event->user));
        }
    }

    private function lockKey(TweetRetweetedEvent $event): string
    {
        return "tweet-retweeted-notification-{$event->tweet->id}-{$event->user->id}";
    }
}
