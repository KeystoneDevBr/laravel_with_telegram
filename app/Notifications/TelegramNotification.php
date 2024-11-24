<?php

namespace App\Notifications;

use App\Http\Controllers\TelegramApi\Types\TelegramMessageTypesExamples;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramBase;
use NotificationChannels\Telegram\TelegramChannel;

class TelegramNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        protected readonly TelegramBase $telegramMessage
    ) {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return [TelegramChannel::class];
    }

    /**
     * Get the Telegram message representation of the notification.
     */
    public function toTelegram(object $notifiable): TelegramBase
    {
        return $this->telegramMessage;
    }

   
}
