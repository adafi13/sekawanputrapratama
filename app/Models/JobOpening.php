<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class JobOpening extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'department',
        'location',
        'type',
        'experience',
        'description',
        'responsibilities',
        'requirements',
        'is_active',
    ];

    protected $casts = [
        'responsibilities' => 'array',
        'requirements' => 'array',
        'is_active' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->title);
            }
        });
    }

    public function applications()
    {
        return $this->hasMany(JobApplication::class);
    }
}
