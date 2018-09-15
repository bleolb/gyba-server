<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private function getToken(Request $request)
    {
        try {
            $data = $request->json()->all();
            $user = User::where('user_name', $data['user_name'])->first();
            if ($user && Hash::check($data['password'], $user->password)) {
                return response()->json($user, 200);
            } else {
                return false;
            }
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'No content'], 406);
        }
    }

    function login(Request $request)
    {
        if ($request->isJson()) {
            try {
                if ($this->getToken($request) != false) {
                    return $this->getToken($request);
                } else {
                    return response()->json([], 401);
                }
            } catch (ModelNotFoundException $e) {
                return response()->json(['error' => 'No content'], 406);
            }
        }
        return response()->json(['error' => 'Unsupported Media Type'], 415, []);
    }

    function logout(Request $request)
    {
        User::find($request->id)->update([
            'api_token' => str_random(60),
        ]);
        return response()->json([], 201);
    }

    function getAllUsers(Request $request)
    {
        if ($request->isJson()) {
            $users = User::orderby($request->field, $request->order)->paginate($request->limit);
            return response()->json($users, 200);
        }
        return response()->json(['error' => 'Unsupported Media Type'], 415, []);
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
        return response()->json(['error' => 'Unsupported Media Type'], 415, []);
    }

    function showUser($id)
    {
        $users = User::findOrFail($id);
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
        return response()->json(['error' => 'Unsupported Media Type'], 415, []);
    }

    function updateUser(Request $request)
    {
        if ($request->isJson()) {
            $data = $request->json()->all();
            $user = User::find($request->id)->update([
                'name' => $data['name'],
                'user_name' => $data['user_name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'api_token' => str_random(60),
            ]);
            return response()->json($user, 201);
        }
        return response()->json(['error' => 'Unsupported Media Type'], 415, []);
    }

    function deleteUser(Request $request)
    {
        $user = User::findOrFail($request->id)->delete();
        return response()->json($user, 201);
    }
}
