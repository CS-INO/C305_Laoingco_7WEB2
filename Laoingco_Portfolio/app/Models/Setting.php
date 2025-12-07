<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['key','value'];
    public $timestamps = true;

    public static function get(string $key, $default = null)
    {
        $row = static::query()->where('key', $key)->first();
        return $row?->value ?? $default;
    }

    public static function set(string $key, $value): void
    {
        static::updateOrCreate(['key' => $key], ['value' => $value]);
    }

    // Convenience for bulk pluck
    public static function asArray(): array
    {
        return static::query()->pluck('value', 'key')->toArray();
    }
}
