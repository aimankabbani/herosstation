<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    /** @use HasFactory<\Database\Factories\SiteFactory> */
    use HasFactory;


    protected $fillable = [
        'name_en',
        'name_ar',
        'slug',
        'domain',
        'path_prefix',
        'logo_path',
        'favicon_path',
        'branding',
        'settings',
        'hero_title_en',
        'hero_title_ar',
        'slogan_en',
        'slogan_ar',
        'hero_image_url'
    ];

    protected $casts = [
        'branding' => 'array',
        'settings' => 'array',
    ];

    protected $appends = ['phone_number'];

    public function pages()
    {
        return $this->hasMany(Page::class);
    }

    public function menus()
    {
        return $this->hasMany(Menu::class);
    }

    public function media()
    {
        return $this->hasMany(Media::class);
    }

    // Only images
    public function images()
    {
        return $this->media()->where('type', 'image');
    }

    // Only videos
    public function videos()
    {
        return $this->media()->where('type', 'video');
    }

    public function getPhoneNumberAttribute()
    {
        return $this->settings['phone_number'] ?? null;
    }
}
