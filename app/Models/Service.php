<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Service extends Model implements HasMedia
{
    use SoftDeletes, Sluggable, InteractsWithMedia;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'content',
        'features',
        'technologies',
        'pricing_starting_from',
        'delivery_time',
        'icon',
        'order',
        'is_active',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'features' => 'array',
        'technologies' => 'array',
        'pricing_starting_from' => 'decimal:2',
        'order' => 'integer',
        'is_active' => 'boolean',
    ];

    public function portfolios(): HasMany
    {
        return $this->hasMany(Portfolio::class, 'service_id');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
            ],
        ];
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images');
        $this->addMediaCollection('icon')
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
            
        // WebP conversion for images
        $this->addMediaConversion('webp')
            ->format('webp')
            ->optimize()
            ->performOnCollections('images');
            
        // WebP conversion for icon
        $this->addMediaConversion('webp')
            ->format('webp')
            ->optimize()
            ->performOnCollections('icon');
    }
}
