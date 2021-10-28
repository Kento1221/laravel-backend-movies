<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateMovieCoverRequest;
use App\Models\Movie;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class MovieCoverController extends Controller
{

    //TODO: use helper method to clean up the controller code.
    /**
     * Update the specified resource in storage.
     *
     * @param UpdateMovieCoverRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMovieCoverRequest $request)
    {
        $movie = Movie::findOrFail($request->validated()['movie_id']);

        if ($movie->cover_url != null) {
            Storage::delete($movie->cover_url);
            $movie->update(['cover_url' => null]);
        }
        $resizedImage = Image::make($request->file('cover_file'))
            ->resize(300, 400)->encode('jpg');
        $fileName = sha1_file($request->file('cover_file')) . '.jpg';
        $created = Storage::disk('public_covers')->put($fileName, $resizedImage);

        return $created
            ? $movie->update([
                'cover_url' => 'public_covers/' . $fileName])
            : abort(409);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $movieId
     * @return \Illuminate\Http\Response
     */
    public function destroy($movieId)
    {
        $movie = Movie::findOrFail($movieId);

        if ($movie->cover_url == null)
            abort(404, 'Cover file not found.');

        $deleted = Storage::delete($movie->cover_url);
        $movie->update(['cover_url' => null]);

        return $deleted;
    }
}
