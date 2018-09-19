<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

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
                return response()->json('ModelNotFound', 200);
            } catch (NotFoundHttpException  $e) {
                return response()->json('NotFoundHttp', 200);
            } catch (Exception $e) {
                return response()->json('Exception', 500);
            } catch (Error $e) {
                return response()->json('Error', 500);
            }
        }
        return response()->json(['error' => 'Unsupported Media Type'], 415, []);
    }

    function logout(Request $request)
    {
        if ($request->isJson()) {
            try {
                User::find($request->id)->update(['api_token' => str_random(60),]);
                return response()->json([], 201);
            } catch (ModelNotFoundException $e) {
                return response()->json('ModelNotFound', 200);
            } catch (NotFoundHttpException  $e) {
                return response()->json('NotFoundHttp', 200);
            } catch (Exception $e) {
                return response()->json('Exception', 500);
            } catch (Error $e) {
                return response()->json('Error', 500);
            }
        }
        return response()->json(['error' => 'Unsupported Media Type'], 415, []);
    }

    function checkUser(Request $request)
    {
        if ($request->isJson()) {
            try {
                $users = User::where('email', '=', $request->email)
                    ->join('professionals', 'professionals.user_id', '=', 'users.id')->get();
                return response()->json($users, 200);
            } catch (ModelNotFoundException $e) {
                return response()->json('ModelNotFound', 200);
            } catch (NotFoundHttpException  $e) {
                return response()->json('NotFoundHttp', 200);
            } catch (Exception $e) {
                return response()->json('Exception', 500);
            } catch (Error $e) {
                return response()->json('Error', 500);
            }
        }
        return response()->json(['error' => 'Unsupported Media Type'], 415, []);
    }

    function getAllUsers(Request $request)
    {
        if ($request->isJson()) {
            try {
                $users = User::orderby($request->field, $request->order)->paginate($request->limit);
                return response()->json($users, 200);
            } catch (ModelNotFoundException $e) {
                return response()->json('ModelNotFound', 200);
            } catch (NotFoundHttpException  $e) {
                return response()->json('NotFoundHttp', 200);
            } catch (Exception $e) {
                return response()->json('Exception', 500);
            } catch (Error $e) {
                return response()->json('Error', 500);
            }
        }
        return response()->json(['error' => 'Unsupported Media Type'], 415, []);
    }

    function filterUsers(Request $request)
    {
        if ($request->isJson()) {
            try {
                //para tener varias condiciones en un array
                //$users = User::orWhere([$request->conditions])
                $data = $request->json()->all();
                $users = User::orWhere('name', 'like', $data['name'] . '%')
                    ->orWhere('user_name', 'like', $data['user_name'] . '%')
                    ->orWhere('email', 'like', $data['email'] . '%')
                    ->orderby($request->field, $request->order)->paginate($request->limit);
                return response()->json($users, 200);
            } catch (ModelNotFoundException $e) {
                return response()->json('ModelNotFound', 200);
            } catch (NotFoundHttpException  $e) {
                return response()->json('NotFoundHttp', 200);
            } catch (Exception $e) {
                return response()->json('Exception', 500);
            } catch (Error $e) {
                return response()->json('Error', 500);
            }
        }
        return response()->json(['error' => 'Unsupported Media Type'], 415, []);
    }

    function showUser(Request $request)
    {
        if ($request->isJson()) {
            try {
                $users = User::findOrFail($request->id);
                return response()->json($users, 200);
            } catch (ModelNotFoundException $e) {
                return response()->json('ModelNotFound', 200);
            } catch (NotFoundHttpException  $e) {
                return response()->json('NotFoundHttp', 200);
            } catch (Exception $e) {
                return response()->json('Exception', 500);
            } catch (Error $e) {
                return response()->json('Error', 500);
            }
        }
        return response()->json(['error' => 'Unsupported Media Type'], 415, []);
    }

    function createUser(Request $request)
    {
        if ($request->isJson()) {
            try {
                $data = $request->json()->all();
                $user = User::create([
                    'name' => $data['name'],
                    'user_name' => $data['user_name'],
                    'email' => $data['email'],
                    'password' => Hash::make($data['password']),
                    'api_token' => str_random(60),
                ]);
                $user->professional()->create([
                    'identity' => $data['identity'],
                    'first_name' => $data['first_name'],
                    'last_name' => $data['last_name'],
                    'nationality' => $data['nationality'],
                    'civil_status' => $data['civil_status'],
                    'birthdate' => $data['birthdate'],
                    'gender' => $data['gender'],
                    'phone' => $data['phone'],
                    'cell_phone' => $data['cell_phone'],
                    'address' => $data['address'],
                    'about_me' => $data['about_me'],
                ]);
                return response()->json($user, 201);
            } catch (ModelNotFoundException $e) {
                return response()->json('ModelNotFound', 200);
            } catch (NotFoundHttpException  $e) {
                return response()->json('NotFoundHttp', 200);
            } catch (Exception $e) {
                return response()->json('Exception', 500);
            } catch (Error $e) {
                return response()->json('Error', 500);
            }
        }

        return response()->json(['error' => 'Unsupported Media Type'], 415, []);
    }

    function updateUser(Request $request)
    {
        if ($request->isJson()) {
            try {
                $data = $request->json()->all();
                $user = User::find($request->id)->update([
                    'name' => $data['name'],
                    'user_name' => $data['user_name'],
                    'email' => $data['email'],
                    'password' => Hash::make($data['password']),
                    'api_token' => str_random(60),
                ]);
                return response()->json($user, 201);
            } catch (ModelNotFoundException $e) {
                return response()->json('ModelNotFound', 200);
            } catch (NotFoundHttpException  $e) {
                return response()->json('NotFoundHttp', 200);
            } catch (Exception $e) {
                return response()->json('Exception', 500);
            } catch (Error $e) {
                return response()->json('Error', 500);
            }
        }
        return response()->json(['error' => 'Unsupported Media Type'], 415, []);
    }

    function deleteUser(Request $request)
    {
        if ($request->isJson()) {
            try {
                $user = User::findOrFail($request->id)->delete();
                return response()->json($user, 201);
            } catch (ModelNotFoundException $e) {
                return response()->json('ModelNotFound', 200);
            } catch (NotFoundHttpException  $e) {
                return response()->json('NotFoundHttp', 200);
            } catch (Exception $e) {
                return response()->json('Exception', 500);
            } catch (Error $e) {
                return response()->json('Error', 500);
            }
        }
        return response()->json(['error' => 'Unsupported Media Type'], 415, []);
    }
}
