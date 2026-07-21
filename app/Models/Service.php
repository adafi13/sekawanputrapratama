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

    public function getIconClassAttribute(): string
    {
        if (!empty($this->icon) && !in_array($this->icon, ['fas fa-cogs', 'fa-cogs', 'fas fa-cog', 'fa-cog'])) {
            return $this->icon;
        }

        $title = strtolower($this->title);
        $slug = strtolower($this->slug);

        if (str_contains($title, 'app') || str_contains($slug, 'app') || str_contains($title, 'mobile') || str_contains($title, 'android') || str_contains($title, 'ios')) {
            return 'fas fa-mobile-alt';
        }

        if (str_contains($title, 'web') || str_contains($slug, 'web') || str_contains($title, 'situs') || str_contains($title, 'toko online')) {
            return 'fas fa-globe';
        }

        if (str_contains($title, 'server') || str_contains($slug, 'server') || str_contains($title, 'infrastruktur') || str_contains($title, 'jaringan') || str_contains($title, 'network') || str_contains($title, 'office')) {
            return 'fas fa-server';
        }

        if (str_contains($title, 'marketing') || str_contains($slug, 'marketing') || str_contains($title, 'seo') || str_contains($title, 'digital')) {
            return 'fas fa-chart-line';
        }

        if (str_contains($title, 'design') || str_contains($title, 'ui') || str_contains($title, 'ux')) {
            return 'fas fa-paint-brush';
        }

        if (str_contains($title, 'consult') || str_contains($slug, 'consult') || str_contains($title, 'konsultan')) {
            return 'fas fa-user-tie';
        }

        return 'fas fa-laptop-code';
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
