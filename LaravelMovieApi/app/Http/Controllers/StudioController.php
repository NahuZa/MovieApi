<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Studio;
use App\Http\Requests\StudioRequest;

class StudioController extends Controller
{
    /**
     * @api {get} /api/studios List all studios
     * @apiName GetStudios
     * @apiGroup Studio
     *
     * @apiSuccess {Object[]} studio List of studios
     * @apiSuccess {Number} studio.id Studio ID
     * @apiSuccess {String} studio.name Studio name
     * @apiSuccess {String} studio.created_at Created time
     * @apiSuccess {String} studio.updated_at Updated time
     */
    public function index(){
        $studio = Studio::all();

        return response()->json([
            'studio' => $studio
        ]);
    }

    /**
     * @api {post} /api/studios Create a new studio
     * @apiName CreateStudio
     * @apiGroup Studio
     *
     * @apiBody {String} name Studio name
     *
     * @apiSuccess {Object} studio Created studio object
     * @apiSuccess {Number} studio.id Studio ID
     * @apiSuccess {String} studio.name Studio name
     * @apiSuccess {String} studio.created_at Created time
     * @apiSuccess {String} studio.updated_at Updated time
     */
    public function store(StudioRequest $request){
        $studio = Studio::create($request->all());
        return response()->json([
            'studio' => $studio
        ]);

    }

    /**
     * @api {put} /api/studios/:id Update studio
     * @apiName UpdateStudio
     * @apiGroup Studio
     *
     * @apiParam {Number} id Studio ID
     * @apiBody {String} name Studio name
     *
     * @apiSuccess {Object} studio Updated studio object
     * @apiSuccess {Number} studio.id Studio ID
     * @apiSuccess {String} studio.name Studio name
     * @apiSuccess {String} studio.created_at Created time
     * @apiSuccess {String} studio.updated_at Updated time
     */
    public function update(StudioRequest $request, $id){
         
        $studio = Studio::findOrFail($id);
        $studio->update($request->all());
        return response()->json([
            'studio' => $studio
        ]);

    }

    /**
     * @api {delete} /api/studios/:id Delete studio
     * @apiName DeleteStudio
     * @apiGroup Studio
     *
     * @apiParam {Number} id Studio ID
     *
     * @apiSuccess {String} message Success message
     * @apiSuccess {Number} id Deleted studio ID
     */
    public function destroy(Request $request, $id){
        $studio = Studio::findOrFail($id);
        $studio->delete();
        return response()->json([
            'message' => 'Studio deleted',
            'id' => $id
        ]);
    }
}
