<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    /**
     * @api {get} /api/categories List all categories
     * @apiName GetCategories
     * @apiGroup Category
     *
     * @apiSuccess {Object[]} categories List of categories
     * @apiSuccess {Number} categories.id Category ID
     * @apiSuccess {String} categories.name Category name
     * @apiSuccess {String} categories.created_at Created time
     * @apiSuccess {String} categories.updated_at Updated time
     */
    public function index(){
        $categories = Category::all();

        return response()->json([
            'categories' => $categories
        ]);
    }


    /**
     * @api {post} /api/categories Create new category
     * @apiName CreateCategory
     * @apiGroup Category
     *
     * @apiBody {String} name Category name
     *
     * @apiSuccess {Object} category Created category object
     * @apiSuccess {Number} category.id Category ID
     * @apiSuccess {String} category.name Category name
     * @apiSuccess {String} category.created_at Created time
     * @apiSuccess {String} category.updated_at Updated time
     */
    public function store(CategoryRequest $request){
        $category= Category::create($request->all());
        return response()->json([
            'category' => $category
        ]);
    }


    /**
     * @api {put} /api/categories/:id Update category
     * @apiName UpdateCategory
     * @apiGroup Category
     *
     * @apiParam {Number} id Category ID
     * @apiBody {String} name Category name
     *
     * @apiSuccess {Object} category Updated category object
     * @apiSuccess {Number} category.id Category ID
     * @apiSuccess {String} category.name Category name
     * @apiSuccess {String} category.created_at Created time
     * @apiSuccess {String} category.updated_at Updated time
     */
    public function update(CategoryRequest $request, $id){
         
        $category = Category::findOrFail($id);
        $category->update($request->all());
        return response()->json([
            'category' => $category
        ]);
    }


    /**
     * @api {delete} /api/categories/:id Delete category
     * @apiName DeleteCategory
     * @apiGroup Category
     *
     * @apiParam {Number} id Category ID
     *
     * @apiSuccess {String} message Success message
     * @apiSuccess {Number} id Deleted category ID
     */
    public function destroy(Request $request, $id){
        $category = Category::findOrFail($id);
        $category->delete();
        return response()->json([
            'message' => 'Category deleted',
            'id' => $id
        ]);
    }
}

