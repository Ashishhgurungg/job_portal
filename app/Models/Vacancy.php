<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Vacancy extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'user_id',
        'category_id',
        'type',
        'salary',
        'deadline',
        'description'
    ];

    protected $casts = [
        'deadline' => 'datetime'
        // 'salary' => 'float'
    ];

    function category()
    {
        return $this->belongsTo(Category::class);
        // return $this->belongsTo(Category::class, 'category_id'); // if we don't follow naming convention
    }
    //belongsTo
    //belongsToMany
    //hasOne
    //hasMany
    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    function user()
    {
        return $this->belongsTo(User::class);
    }
}
