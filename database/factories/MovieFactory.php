<?php

namespace Database\Factories;

use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),
            'cover_url' => $this->faker->imageUrl(500, 500),
            'description' => $this->faker->sentences(2, true),
            'country_id' => Country::inRandomOrder()->first()->id,
        ];
    }

    /**
     * Indicate that the movie has no cover_url (cover_url = null).
     *
     * @return Factory
     */
    public function withNoCoverUrl()
    {
        return $this->state(function (array $attributes) {
            return ['cover_url' => null];
        });
    }
}
