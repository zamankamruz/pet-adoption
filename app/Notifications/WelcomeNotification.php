<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class WelcomeNotification extends Notification
{
    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Welcome to Furry Friends!')
            ->greeting('Hi ' . $notifiable->name . '!')
            ->line('Thanks for joining Furry Friends. We’re so glad you’re here!')
            ->action('Visit Dashboard', url('/dashboard'))
            ->line('Let us know if you need any help.');
    }
}

