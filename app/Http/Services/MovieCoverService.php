<?php

namespace App\Http\Services;

use App\Models\Movie;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class MovieCoverService
{
    /**
     * Update or store the movie cover in storage.
     *
     * @param int $movieId
     * @param \Illuminate\Http\UploadedFile $coverFile
     * @return \Illuminate\Http\Response
     */
    public static function updateOrStore($movieId, $coverFile, $cover_width = 300, $cover_height = 400)
    {
        $fileName = sha1_file($coverFile) . '.jpg';

        $movie = Movie::find($movieId);

        if ($movie->cover_url != null) {
            Storage::delete($movie->cover_url);
            $movie->update(['cover_url' => null]);
        }
        $resizedImage = Image::make($coverFile)
            ->resize($cover_width, $cover_height)
            ->encode('jpg');

        Storage::disk('public_covers')->put($fileName, $resizedImage);
        $updated = $movie->update(['cover_url' => 'public_covers/' . $fileName]);

        return $updated
            ? response()
            : response('Cover file not updated successfully.', 409);
    }

    /**
     * Delete the existing movie cover from storage.
     *
     * @param int $movieId
     * @return \Illuminate\Http\Response
     */
    public static function delete($movieId)
    {
        $movie = Movie::findOrFail($movieId);

        if ($movie->cover_url == null)
            return response('Cover file not found.', 404);

        $deleted = Storage::delete($movie->cover_url);
        if ($deleted) {
            $movie->update(['cover_url' => null]);
            return response();
        }

        return response('Cover file not deleted successfully.', 409);
    }
}
