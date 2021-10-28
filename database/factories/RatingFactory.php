<?php

namespace Database\Factories;

use App\Models\Movie;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class RatingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'movie_id' => Movie::inRandomOrder()->first()->id,
            'user_id' =>User::inRandomOrder()->first()->id,
            'value' => rand(1,5),
            "created_at" => now(),
            "updated_at" => now()
        ];
    }
}
