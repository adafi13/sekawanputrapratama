<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected $fillable = [
        'key',
        'value',
        'type',
        'group',
        'description',
    ];

    public static function get(string $key, mixed $default = null): mixed
    {
        return Cache::remember("setting.{$key}", now()->addHours(24), function () use ($key, $default) {
            $setting = static::where('key', $key)->first();
            return $setting ? $setting->value : $default;
        });
    }

    public static function set(string $key, mixed $value, string $type = 'text', string $group = 'general', ?string $description = null): void
    {
        static::updateOrCreate(
            ['key' => $key],
            [
                'value' => $value,
                'type' => $type,
                'group' => $group,
                'description' => $description,
            ]
        );

        Cache::forget("setting.{$key}");
    }

    public static function getGroup(string $group): array
    {
        return Cache::remember("settings.group.{$group}", now()->addHours(24), function () use ($group) {
            return static::query()
                ->where('group', $group)
                ->get()
                ->mapWithKeys(function ($setting) {
                    return [$setting->key => $setting->value];
                })
                ->toArray();
        });
    }

    public static function getAllGrouped(): array
    {
        return Cache::remember('settings.all.grouped', now()->addHours(24), function () {
            return static::orderBy('group')
                ->orderBy('key')
                ->get()
                ->groupBy('group')
                ->map(function ($settings) {
                    return $settings->mapWithKeys(function ($setting) {
                        return [$setting->key => $setting->value];
                    });
                })
                ->toArray();
        });
    }

    public static function clearCache(?string $key = null): void
    {
        if ($key) {
            Cache::forget("setting.{$key}");
            Cache::forget('settings.all.grouped');
            Cache::forget('settings.group.' . static::where('key', $key)->value('group'));
        } else {
            Cache::flush();
        }
    }

    protected static function booted(): void
    {
        static::saved(function ($setting) {
            Cache::forget("setting.{$setting->key}");
            Cache::forget('settings.all.grouped');
            Cache::forget("settings.group.{$setting->group}");
        });

        static::deleted(function ($setting) {
            Cache::forget("setting.{$setting->key}");
            Cache::forget('settings.all.grouped');
            Cache::forget("settings.group.{$setting->group}");
        });
    }
}
