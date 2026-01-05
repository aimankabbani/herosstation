<?php

namespace App\Models;

use App\StationType;
use Illuminate\Database\Eloquent\Model;

class PhoneNumbers extends Model
{
    protected $table = 'phone_numbers';

    protected $fillable = [
        'phone',
        'hall_id',
        'name',
        'gender',
        'date_of_birth',
        'occurrence_count'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-d-m H:i',
    ];

    public function hall()
    {
        return $this->belongsTo(Halls::class);
    }
}
