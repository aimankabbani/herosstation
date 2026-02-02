<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use HTMLPurifier;
use HTMLPurifier_Config;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_id',
        'title_en',
        'title_ar',
        'slug',
        'content_en',
        'content_ar',
        'is_published',
        'order',
        'type'
    ];

    public function site()
    {
        return $this->belongsTo(Site::class);
    }

    public function getContentEnAttribute($value)
    {
        $config = HTMLPurifier_Config::createDefault();
        $purifier = new HTMLPurifier($config);

        return $purifier->purify($value);
    }

    public function getContentArAttribute($value)
    {
        $config = HTMLPurifier_Config::createDefault();
        $purifier = new HTMLPurifier($config);
        
        return $purifier->purify($value);
    }
}
