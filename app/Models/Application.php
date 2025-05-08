<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Application extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'vacancy_id',
        'resume',
        'cover_letter',
        'status'
    ];

    
    function user()
    {
        return $this->belongsTo(User::class);
    }

    function vacancy()
    {
        return $this->belongsTo(Vacancy::class);
    }
}
