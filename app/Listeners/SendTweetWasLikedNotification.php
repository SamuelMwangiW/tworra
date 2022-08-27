<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\TweetLikedEvent;
use App\Notifications\TweetWasLiked;
use Illuminate\Support\Facades\Cache;

class SendTweetWasLikedNotification
{
    public function handle(TweetLikedEvent $event): void
    {
        $lock = Cache::lock($this->lockKey($event), 86400);

        if ($lock->get()) {
            $event->tweet->load(['user']);

            /** @phpstan-ignore-next-line  */
            $event->tweet->user->notify(new TweetWasLiked($event->tweet, $event->user));
        }
    }

    private function lockKey(TweetLikedEvent $event): string
    {
        return "SendTweetWasLikedNotification-{$event->tweet->id}-{$event->user->id}";
    }
}
