<?php

declare(strict_types=1);

namespace App\Notifications;

use App\Models\Tweet;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TweetWasRetweeted extends Notification implements ShouldQueue, ShouldBeUnique
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(public readonly Tweet $tweet, public readonly User $user)
    {
        //
    }

    public function uniqueId(): string
    {
        return "{$this->tweet->id}-{$this->user->id}";
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array<int,string>
     */
    public function via($notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param User $notifiable
     * @return MailMessage
     */
    public function toMail(User $notifiable): MailMessage
    {
        return (new MailMessage())
            ->subject("@{$this->user->username} Retweeted your tweet")
            ->greeting("Hey @{$notifiable->username}")
            ->line("{$this->user->name} retweeted your tweet")
            ->action('View tweet', route('tweet.show', ['user' => $notifiable, 'tweet' => $this->tweet]))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array<string,mixed>
     */
    public function toArray($notifiable): array
    {
        return [
            'type' => TweetWasRetweeted::class,
            'user' => [
                'id' => $this->user->id,
                'username' => $this->user->username,
            ],
            'tweet' => $this->tweet->id,
        ];
    }
}
