<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Menu extends Model
{
    /** @use HasFactory<\Database\Factories\MenuFactory> */
    use HasFactory;

    protected $fillable = ['site_id', 'name'];

    public function site()
    {
        return $this->belongsTo(Site::class);
    }

    public function items()
    {
        return $this->hasMany(MenuItem::class);
    }
}
