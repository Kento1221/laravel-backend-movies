<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateMovieRatingRequest;
use App\Models\Movie;
use Illuminate\Http\Request;

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
            'user_id' => $request->validated()['user_id'],
            'value' => $request->validated()['value']
        ];
        $movie = Movie::find($data['movie_id']);
        $record = $movie->ratings()
            ->where('user_id', $data['user_id'])
            ->where('movie_id', $data['movie_id'])
            ->first();

        if ($record != null)
            $record->update(['value' => $data['value']]);
        else
            $record = $movie->ratings()->create($data);

        return $record;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //TODO: Programme it after integrating Sanctum Authentication.
    }
}
