<?php

namespace App\Http\Services;

use App\Models\Movie;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;

class RatingService
{
    /**
     * Update or store the movie rating in storage of the authenticated user.
     *
     * @param int $movieId
     * @param int $value
     * @return \Illuminate\Http\Response
     */
    public static function updateOrStore($movieId, $value)
    {
        $data = [
            'movie_id' => $movieId,
            'value' => $value,
            'user_id' => Auth::id(),
        ];
        $movie = Movie::find($data['movie_id']);
        $rating = $movie->ratings()
            ->where('user_id', Auth::id())
            ->where('movie_id', $data['movie_id'])
            ->first();

        if ($rating != null) {
            if (Auth::user()->cannot('update', $rating))
                return response('Cannot update. Permission denied.', 403);

            $rating->update(['value' => $data['value']]);
        } else {
            if (Auth::user()->cannot('create', Rating::class))
                return response('Cannot create. Permission denied.', 403);

            $rating = $movie->ratings()->create($data);
        }

        return $rating;
    }
}
