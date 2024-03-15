<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    // public $paymentMethod; // Tambahkan properti untuk menyimpan paymentMethod

    /**
     * Create a new message instance.
     */
    public function __construct(array $data) // Tambahkan $paymentMethod sebagai parameter
    {
        $this->data = $data;
        // $this->paymentMethod = $paymentMethod;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Shipwrecked Bali - Pubcrawl',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'client.email',
            with: ['data' => $this->data] 
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}