<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = ['movie_id', 'user_id', 'value'];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function movie()
    {
        return $this->hasOne(Movie::class);
    }
}
