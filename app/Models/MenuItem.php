<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    /** @use HasFactory<\Database\Factories\MenuItemFactory> */
    use HasFactory;


    protected $fillable = ['menu_id', 'title', 'url', 'page_id', 'order'];
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
