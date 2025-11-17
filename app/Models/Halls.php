<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Halls extends Model
{
    protected $table = 'halls';

    protected $fillable = ['name_ar', 'name_en'];

    public function phoneNumbers()
    {
        return $this->hasMany(PhoneNumbers::class);
    }
}
