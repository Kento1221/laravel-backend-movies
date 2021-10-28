<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMovieRequest;
use App\Http\Requests\UpdateMovieRequest;
use App\Models\Movie;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Movie::paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreMovieRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMovieRequest $request)
    {
        $movie = Movie::create($request->except('genres'));
        if(isset($request->validated()['genres']))
            $movie->genres()->sync($request->validated()['genres']);
        return $movie->load('genres','country');
    }

    /**
     * Display the specified resource.
     *
     * @param Movie $movie
     * @return \Illuminate\Http\Response
     */
    public function show(Movie $movie)
    {
        return $movie->load('genres', 'country', 'ratings');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateMovieRequest $request
     * @param Movie $movie
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMovieRequest $request, Movie $movie)
    {
        if (isset($request->validated()['genres']))
            $movie->genres()->sync($request->validated()['genres']);

        $result = $movie->update($request->except('genres'));

        return $movie->load('genres', 'country');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Movie $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        return $movie->delete();
    }
}
