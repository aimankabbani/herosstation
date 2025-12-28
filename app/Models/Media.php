<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    /** @use HasFactory<\Database\Factories\MediaFactory> */
    use HasFactory;

    protected $fillable = ['site_id', 'file_path', 'type', 'alt'];

    public function site()
    {
        return $this->belongsTo(Site::class);
    }
}
