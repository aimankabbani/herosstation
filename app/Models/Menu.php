<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Menu extends Model
{
    /** @use HasFactory<\Database\Factories\MenuFactory> */
    use HasFactory;

    protected $fillable = [
        'site_id',
        'title_ar',
        'title_en',
        'url',
        'order',
        'active',
        'page_id',
    ];

    public function site()
    {
        return $this->belongsTo(Site::class);
    }

    public function items()
    {
        return $this->hasMany(MenuItem::class);
    }

    protected static function booted()
    {
        static::saved(fn() => cache()->flush());
        static::deleted(fn() => cache()->flush());
    }

    protected static function scopeActive($query)
    {
        return $query->where('active', true);
    }

    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    public function getLinkAttribute()
    {
        if ($this->page) {
            return url(app()->getLocale() . '/' . $this->page->slug);
        }

        return $this->url;
    }
}
