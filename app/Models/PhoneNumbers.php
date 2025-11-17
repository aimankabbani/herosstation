<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhoneNumbers extends Model
{
    protected $table = 'phone_numbers';

    protected $fillable = ['phone', 'hall_id'];

    public function hall()
    {
        return $this->belongsTo(Halls::class);
    }
}
