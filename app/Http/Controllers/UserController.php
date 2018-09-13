<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    function getToken(Request $request)
    {
        if ($request->isJson()) {
            try {
                $data = $request->json()->all();
                $user = User::where('user_name', $data['user_name'])->first();
                if ($user && Hash::check($data['password'], $user->password)) {
                    return response()->json($user, 200);
                } else {
                    return response()->json(['error' => 'No content'], 406);
                }
            } catch (ModelNotFoundException $e) {
                return response()->json(['error' => 'No content'], 406);
            }
        }
        return response()->json(['error' => 'Unathorized'], 401, []);
    }

    function getAllUsers(Request $request)
    {
        if ($request->isJson()) {
            $users = User::orderby($request->field, $request->order)->paginate($request->limit);
            return response()->json($users, 200);
        }
        return response()->json(['error' => 'Unathorized'], 401, []);
    }

    function filterUsers(Request $request)
    {
        if ($request->isJson()) {
            //para tener varias condiciones en un array
            //$users = User::orWhere([$request->conditions])
            $data = $request->json()->all();
            $users = User::orWhere('name', 'like', $data['name'] . '%')
                ->orWhere('user_name', 'like', $data['user_name'] . '%')
                ->orWhere('email', 'like', $data['email'] . '%')
                ->orderby($request->field, $request->order)->paginate($request->limit);
            return response()->json($users, 200);
        }
        return response()->json(['error' => 'Unathorized'], 401, []);
    }

    function showUser($id)
    {
        $users = User::find($id);
        return response()->json($users, 200);
    }

    function createUser(Request $request)
    {
        if ($request->isJson()) {
            $data = $request->json()->all();
            $user = User::create([
                'name' => $data['name'],
                'user_name' => $data['user_name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'api_token' => str_random(60),
            ]);
            return response()->json($user, 201);
        }
        return response()->json(['error' => 'Unathorized'], 401, []);
    }

    function updateUser(Request $request, $id)
    {
        if ($request->isJson()) {
            $data = $request->json()->all();
            $user = User::find($id)->update([
                'name' => $data['name'],
                'user_name' => $data['user_name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'api_token' => str_random(60),
            ]);
            return response()->json($user, 201);
        }
        return response()->json(['error' => 'Unathorized'], 401, []);
    }

    function deleteUser($id)
    {
        $user = User::findOrFail($id)->delete();
        return response()->json($user, 201);
    }
}
