<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Testimonial extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia;

    protected $fillable = [
        'testimonial',
        'client_name',
        'client_company',
        'company_industry',
        'client_position',
        'rating',
        'is_verified',
        'is_featured',
        'order',
    ];

    protected $casts = [
        'rating' => 'integer',
        'is_verified' => 'boolean',
        'is_featured' => 'boolean',
        'order' => 'integer',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('client_photo')
            ->singleFile();
        $this->addMediaCollection('client_logo')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp']);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        // Thumbnail conversion for client_photo
        $this->addMediaConversion('thumb')
            ->width(100)
            ->height(100)
            ->sharpen(10)
            ->optimize()
            ->performOnCollections('client_photo');
            
        // WebP conversion for client_photo
        $this->addMediaConversion('webp')
            ->format('webp')
            ->optimize()
            ->performOnCollections('client_photo');
            
        // Thumbnail conversion for client_logo
        $this->addMediaConversion('thumb')
            ->width(100)
            ->height(100)
            ->sharpen(10)
            ->optimize()
            ->performOnCollections('client_logo');
            
        // WebP conversion for client_logo
        $this->addMediaConversion('webp')
            ->format('webp')
            ->optimize()
            ->performOnCollections('client_logo');
    }
}
