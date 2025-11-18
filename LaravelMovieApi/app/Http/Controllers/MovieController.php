<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovieRequest;
use Illuminate\Http\Request;
use App\Models\Movie;

class MovieController extends Controller
{
    /**
     * @api {get} /api/movies List all movies
     * @apiName GetMovies
     * @apiGroup Movie
     *
     * @apiSuccess {Object[]} movies List of movies
     * @apiSuccess {Number} movies.id Movie ID
     * @apiSuccess {String} movies.title Movie title
     * @apiSuccess {String} movies.description Movie description
     * @apiSuccess {Number} movies.year Release year
     * @apiSuccess {String} movies.created_at Created time
     * @apiSuccess {String} movies.updated_at Updated time
     */
    public function index(){
        $movies = Movie::all();

        return response()->json([
            'movies' => $movies
        ]);
    }

    /**
     * @api {post} /api/movies Create a new movie
     * @apiName CreateMovie
     * @apiGroup Movie
     *
     * @apiBody {String} title Movie title
     * @apiBody {String} description Movie description
     * @apiBody {Number} year Release year
     *
     * @apiSuccess {Object} movie Created movie object
     * @apiSuccess {Number} movie.id Movie ID
     * @apiSuccess {String} movie.title Movie title
     * @apiSuccess {String} movie.description Movie description
     * @apiSuccess {Number} movie.year Release year
     * @apiSuccess {String} movie.created_at Created time
     * @apiSuccess {String} movie.updated_at Updated time
     */
    public function store(MovieRequest $request){
        $movie = Movie::create($request->all());
        return response()->json([
            'movie' => $movie
        ]);
    }

    /**
     * @api {put} /api/movies/:id Update movie
     * @apiName UpdateMovie
     * @apiGroup Movie
     *
     * @apiParam {Number} id Movie ID
     * @apiBody {String} title Movie title
     * @apiBody {String} description Movie description
     * @apiBody {Number} year Release year
     *
     * @apiSuccess {Object} movie Updated movie object
     * @apiSuccess {Number} movie.id Movie ID
     * @apiSuccess {String} movie.title Movie title
     * @apiSuccess {String} movie.description Movie description
     * @apiSuccess {Number} movie.year Release year
     * @apiSuccess {String} movie.created_at Created time
     * @apiSuccess {String} movie.updated_at Updated time
     */
    public function update(MovieRequest $request, $id){
         
        $movie = Movie::findOrFail($id);
        $movie->update($request->all());
        return response()->json([
            'movie' => $movie
        ]);
    }

    /**
     * @api {delete} /api/movies/:id Delete movie
     * @apiName DeleteMovie
     * @apiGroup Movie
     *
     * @apiParam {Number} id Movie ID
     *
     * @apiSuccess {String} message Success message
     * @apiSuccess {Number} id Deleted movie ID
     */
    public function destroy(Request $request, $id){
        $movie = Movie::findOrFail($id);
        $movie->delete();
        return response()->json([
            'message' => 'Movie deleted',
            'id' => $id
        ]);
    }
}

