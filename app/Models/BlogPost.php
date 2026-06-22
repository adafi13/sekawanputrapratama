<?php

namespace App\Models;

use App\Mail\NewBlogPostNewsletter;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Mail;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class BlogPost extends Model implements HasMedia
{
    use SoftDeletes, Sluggable, InteractsWithMedia;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'category_id',
        'author_id',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'status',
        'published_at',
        'views',
        'newsletter_sent_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'newsletter_sent_at' => 'datetime',
        'views' => 'integer',
    ];

    /**
     * Email every active newsletter subscriber about this post, but only once
     * — the first time it's saved with status=published.
     */
    public function notifySubscribersIfPublished(): void
    {
        if ($this->status !== 'published' || $this->newsletter_sent_at !== null) {
            return;
        }

        NewsletterSubscriber::where('is_active', true)
            ->each(function (NewsletterSubscriber $subscriber) {
                Mail::to($subscriber->email)->send(new NewBlogPostNewsletter($this, $subscriber));
            });

        $this->update(['newsletter_sent_at' => now()]);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
            ],
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(BlogCategory::class, 'category_id');
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('featured_image')
            ->singleFile();
    }
}
