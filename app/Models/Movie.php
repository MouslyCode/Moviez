<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Movie extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'title',
        'date',
    ];

    public function genres()
    {
        return $this->belongsToMany(Genre::class,'genre_movie');
    }
    public function activity()
    {
        return $this->hasMany(Activity::class);
    }
}
