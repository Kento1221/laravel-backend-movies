<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
}
