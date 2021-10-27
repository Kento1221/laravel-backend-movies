<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\Genre;
use App\Models\Movie;
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
        $user = new User([
            'name' => 'Kamil Orkisz',
            'email' => 'kamil@email.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
            'is_admin' => true,
            'remember_token' => null,
        ]);

        User::factory(20)->create();
        Genre::factory(20)->create();
        Country::factory(20)->create();
        Movie::factory(50)->create();
        Movie::factory(10)->withNoCoverUrl()->create();

        //Populate the movie_genre_movie pivot table
        $genres = Genre::all();
        Movie::all()->each(function ($movie) use ($genres) {
            $movie
                ->genres()
                ->attach(
                    $genres->random(rand(1, 3))->pluck('id')->toArray()
                );
        });
    }
}
