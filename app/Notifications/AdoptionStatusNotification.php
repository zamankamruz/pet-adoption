<?php

namespace App\Notifications;

use App\Models\Adoption;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdoptionStatusNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public Adoption $adoption) {}

    /** @return array|string */
    public function via($notifiable)
    {
        // Send an e-mail + store in database
        return ['mail', 'database'];
    }

    /** Build the e-mail message. */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Your adoption request has been ' . ucfirst($this->adoption->status))
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('Pet: ' . $this->adoption->pet->name)
            ->line('Current status: ' . ucfirst($this->adoption->status))
            ->when($this->adoption->status === 'rejected', function (MailMessage $mail) {
                $mail->line('Reason: ' . ($this->adoption->rejection_reason ?? '—'));
            })
            ->action('View request', url(route('adoption.showRequest', $this->adoption)))
            ->line('Thank you for using our platform!');
    }

    /** Save a copy in the notifications table. */
    public function toDatabase($notifiable)
    {
        return [
            'adoption_id'  => $this->adoption->id,
            'pet_name'     => $this->adoption->pet->name,
            'status'       => $this->adoption->status,
            'reference'    => $this->adoption->reference_number,
        ];
    }
}
