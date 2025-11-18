<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * @api {post} /api/login User login
     * @apiName LoginUser
     * @apiGroup User
     *
     * @apiBody {String} email User email
     * @apiBody {String} password User password
     *
     * @apiSuccess {Object} user User object including token
     * @apiSuccess {Number} user.id User ID
     * @apiSuccess {String} user.name User name
     * @apiSuccess {String} user.email User email
     * @apiSuccess {String} user.token Access token
     *
     * @apiError (401 Unauthorized) {String} message Invalid email or password
     */
    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $email)->first();

        if (!$user || !Hash::check($password, $password ? $user->password : '')) {
            return response()->json([
                'message' => 'Invalid email or password',
            ], 401);
        }

        // revoke old tokens
        $user->tokens()->delete();

        $user->token = $user->createToken('access')->plainTextToken;

        return response()->json([
            'user' => $user,
        ]);
    }

    /**
     * @api {get} /api/users List all users
     * @apiName GetUsers
     * @apiGroup User
     *
     * @apiSuccess {Object[]} users List of users
     * @apiSuccess {Number} users.id User ID
     * @apiSuccess {String} users.name User name
     * @apiSuccess {String} users.email User email
     * @apiSuccess {String} users.created_at Created time
     * @apiSuccess {String} users.updated_at Updated time
     */
    public function index(Request $request)
    {
        $users = User::all();
        return response()->json([
            'users' => $users,
        ]);
    }
}

