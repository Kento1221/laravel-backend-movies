<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateMovieRatingRequest;
use App\Http\Services\RatingService;
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
        return RatingService::updateOrStore(
            $request->validated()['movie_id'],
            $request->validated()['value']
        );
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
