<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Countries extends Model
{
    protected $table = 'countries';

    protected $fillable = ['name', 'code', 'flag', 'dial_code', 'code'];
}
