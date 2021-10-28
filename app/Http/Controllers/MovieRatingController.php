<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieRatingController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Movie $movie
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Movie $movie)
    {
        return response()->json([
            'movie_rating_count' => $movie->ratings()->count(),
            'movie_rating_avg' => $movie->ratings()->avg('value')
        ]);
    }
}
