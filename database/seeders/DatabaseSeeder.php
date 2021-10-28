<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Rating;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //Create a debug admin user
        User::create([
            'name' => 'Kamil Orkisz',
            'email' => 'kamil@email.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
            'is_admin' => true,
            'remember_token' => null,
        ]);
        User::factory(20)->create();
        Genre::insert(Genre::factory(20)->make()->toArray());
        Country::insert(Country::factory(20)->make()->toArray());
        Movie::insert(Movie::factory(50)->make()->toArray());
        Movie::insert(Movie::factory(10)->withNoCoverUrl()->make()->toArray());

        //Populate the genre_movie pivot table
        $genres = Genre::all();
        Movie::all()->each(function ($movie) use ($genres) {
            $movie
                ->genres()
                ->attach(
                    $genres->random(rand(1, 3))->pluck('id')->toArray()
                );
        });

        Rating::insert(Rating::factory(50)->make()->toArray());
    }
}
