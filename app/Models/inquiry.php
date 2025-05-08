<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class inquiry extends Model
{
    protected $fillable = [
        'name',
        'email',
        'inquiry',
        'message'
    ];
}
