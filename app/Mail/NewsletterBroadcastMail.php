<?php
// File: NewsletterBroadcastMail.php
// Path: /app/Mail/NewsletterBroadcastMail.php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\NewsletterSubscriber;

class NewsletterBroadcastMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $messageContent;
    public $subscriber;

    public function __construct($subject, $messageContent, NewsletterSubscriber $subscriber)
    {
        $this->subject = $subject;
        $this->messageContent = $messageContent;
        $this->subscriber = $subscriber;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.newsletter-broadcast',
            with: [
                'messageContent' => $this->messageContent,
                'subscriber' => $this->subscriber,
                'unsubscribeUrl' => route('newsletter.unsubscribe', $this->subscriber->unsubscribe_token)
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}