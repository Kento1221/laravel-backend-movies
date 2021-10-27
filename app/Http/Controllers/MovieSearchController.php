<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchMovieRequest;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieSearchController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  SearchMovieRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(SearchMovieRequest $request)
    {
        return Movie::where('title', 'LIKE', "%{$request->validated()['title']}%")->paginate(10);
    }
}
