<?php

declare(strict_types=1);

namespace App\Events;

use App\Models\Tweet;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TweetLikedEvent implements ShouldBroadcast
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public function __construct(
        public readonly Tweet $tweet,
        public readonly User $user
    ) {
    }

    public function broadcastOn(): Channel
    {
        return new PrivateChannel('tweet-liked');
    }
}
