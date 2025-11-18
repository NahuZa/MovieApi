<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Director;
use App\Http\Requests\DirectorRequest;

class DirectorController extends Controller
{
    /**
     * @api {get} /api/directors List all directors
     * @apiName GetDirectors
     * @apiGroup Director
     *
     * @apiSuccess {Object[]} directors List of directors
     * @apiSuccess {Number} directors.id Director ID
     * @apiSuccess {String} directors.name Director name
     * @apiSuccess {String} directors.created_at Created time
     * @apiSuccess {String} directors.updated_at Updated time
     */
    public function index(){
        $directors = Director::all();

        return response()->json([
            'directors' => $directors
        ]);
    }

    /**
     * @api {post} /api/directors Create a new director
     * @apiName CreateDirector
     * @apiGroup Director
     *
     * @apiBody {String} name Director name
     *
     * @apiSuccess {Object} director Created director object
     * @apiSuccess {Number} director.id Director ID
     * @apiSuccess {String} director.name Director name
     * @apiSuccess {String} director.created_at Created time
     * @apiSuccess {String} director.updated_at Updated time
     */
    public function store(DirectorRequest $request){
        $director = Director::create($request->all());
        return response()->json([
            'director' => $director
        ]);
    }

    /**
     * @api {put} /api/directors/:id Update director
     * @apiName UpdateDirector
     * @apiGroup Director
     *
     * @apiParam {Number} id Director ID
     * @apiBody {String} name Director name
     *
     * @apiSuccess {Object} director Updated director object
     * @apiSuccess {Number} director.id Director ID
     * @apiSuccess {String} director.name Director name
     * @apiSuccess {String} director.created_at Created time
     * @apiSuccess {String} director.updated_at Updated time
     */
    public function update(DirectorRequest $request, $id){
         
        $director = Director::findOrFail($id);
        $director->update($request->all());
        return response()->json([
            'director' => $director
        ]);
    }

    /**
     * @api {delete} /api/directors/:id Delete director
     * @apiName DeleteDirector
     * @apiGroup Director
     *
     * @apiParam {Number} id Director ID
     *
     * @apiSuccess {String} message Success message
     * @apiSuccess {Number} id Deleted director ID
     */
    public function destroy(Request $request, $id){
        $director = Director::findOrFail($id);
        $director->delete();
        return response()->json([
            'message' => 'Director deleted',
            'id' => $id
        ]);
    }
}

