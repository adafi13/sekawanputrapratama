<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AdminLeadNotification extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function envelope(): Envelope
    {
        // Subject Email untuk Admin (Lebih Informatif)
        return new Envelope(
            subject: '🔔 LEAD BARU: ' . $this->data['company_name'] . ' - ' . $this->data['service'],
        );
    }

    public function content(): Content
    {
        // Kita akan buat view baru khusus admin
        return new Content(
            view: 'emails.admin_notification',
        );
    }
}