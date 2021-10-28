<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateMovieCoverRequest;
use App\Http\Services\MovieCoverService;
use App\Models\Movie;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class MovieCoverController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param UpdateMovieCoverRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMovieCoverRequest $request)
    {
        return MovieCoverService::updateOrStore(
            $request->validated()['movie_id'],
            $request->file('cover_file')
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $movieId
     * @return \Illuminate\Http\Response
     */
    public function destroy($movieId)
    {
        return MovieCoverService::delete($movieId);
    }
}
