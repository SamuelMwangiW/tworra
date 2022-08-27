<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserWasFollowed extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(public readonly User $follower)
    {
        //
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
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail(User $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject("@{$this->follower->username} follows you")
            ->greeting("Hey {$notifiable->name},")
            ->line('You have a new follower.')
            ->line("{$this->follower->name} is now following you.")
            ->action("{$this->follower->username}'s profile", route('show-user-profile', $this->follower))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param User $notifiable
     * @return array<string,mixed>
     */
    public function toArray(User $notifiable): array
    {
        return [
            'type' => UserWasFollowed::class,
            'followee' => $notifiable->id,
            'follower' => [
                'id' => $this->follower->id,
                'username' => $this->follower->username,
            ],
        ];
    }
}
