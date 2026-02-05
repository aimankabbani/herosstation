<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{
    use HasFactory;

    protected $table = 'ads';

    protected $fillable = [
        'active',
        'image_url',
        'order',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query
            ->where('active', true)
            ->orderBy('order');
    }
}
