<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'order'
    ];

    public function site()
    {
        return $this->belongsTo(Site::class);
    }
}
