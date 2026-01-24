<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Portfolio extends Model implements HasMedia
{
    use SoftDeletes, Sluggable, InteractsWithMedia;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'content',
        'featured_image',
        'images',
        'challenge',
        'solution',
        'results',
        'metrics',
        'category_id',
        'service_id',
        'client_name',
        'client_industry',
        'project_date',
        'project_duration',
        'project_url',
        'technologies',
        'is_featured',
        'order',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'project_date' => 'date',
        'technologies' => 'array',
        'metrics' => 'array',
        'images' => 'array',
        'is_featured' => 'boolean',
        'order' => 'integer',
    ];

    protected static function booted(): void
    {
        static::saving(function (Portfolio $portfolio) {
            // Convert comma-separated string to array if needed
            if (is_string($portfolio->technologies)) {
                $portfolio->technologies = array_map('trim', explode(',', $portfolio->technologies));
            }
        });
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
        return $this->belongsTo(PortfolioCategory::class, 'category_id');
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images');
        $this->addMediaCollection('featured_image')
            ->singleFile();
    }

    public function registerMediaConversions(Media $media = null): void
    {
        // Thumbnail conversion for images
        $this->addMediaConversion('thumb')
            ->width(300)
            ->height(300)
            ->sharpen(10)
            ->optimize()
            ->performOnCollections('images');
            
        // Medium conversion for images
        $this->addMediaConversion('medium')
            ->width(800)
            ->height(600)
            ->sharpen(10)
            ->optimize()
            ->performOnCollections('images');
            
        // Thumbnail conversion for featured_image
        $this->addMediaConversion('thumb')
            ->width(400)
            ->height(300)
            ->sharpen(10)
            ->optimize()
            ->performOnCollections('featured_image');
            
        // WebP conversion for featured_image
        $this->addMediaConversion('webp')
            ->format('webp')
            ->optimize()
            ->performOnCollections('featured_image');
    }
}
