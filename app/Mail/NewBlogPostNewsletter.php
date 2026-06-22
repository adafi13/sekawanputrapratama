<?php

namespace App\Mail;

use App\Models\BlogPost;
use App\Models\NewsletterSubscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class NewBlogPostNewsletter extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(
        public BlogPost $post,
        public NewsletterSubscriber $subscriber,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Artikel Baru: ' . $this->post->title,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.newsletter.new_blog_post',
            with: [
                'post' => $this->post,
                'unsubscribeUrl' => URL::signedRoute('newsletter.unsubscribe', ['subscriber' => $this->subscriber->id]),
            ],
        );
    }
}
