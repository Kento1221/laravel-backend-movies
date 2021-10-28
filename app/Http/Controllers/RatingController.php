<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateMovieRatingRequest;
use App\Models\Movie;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMovieRatingRequest $request)
    {
        $data = [
            'movie_id' => $request->validated()['movie_id'],
            'value' => $request->validated()['value'],
            'user_id' => Auth::id(),
        ];
        $movie = Movie::find($data['movie_id']);
        $rating = $movie->ratings()
            ->where('user_id', Auth::id())
            ->where('movie_id', $data['movie_id'])
            ->first();

        if ($rating != null) {

            $this->authorize('update', $rating);

            $rating->update(['value' => $data['value']]);

        } else {

            $this->authorize('create', Rating::class);


            $rating = $movie->ratings()->create($data);
        }

        return $rating;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Rating $rating
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rating $rating)
    {
        $this->authorize('delete', $rating);

        return $rating->delete();
    }
}
