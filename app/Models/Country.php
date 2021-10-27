<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['name'];

    public function Movies()
    {
        return $this->hasMany(Movie::class);
    }
}
