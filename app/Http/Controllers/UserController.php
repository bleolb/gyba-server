<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function prueba()
    {
        $users = User::where('user_name', '1724909443')
            ->join("role_user", "role_user.user_id", "=", "users.id")
            ->join("roles", "roles.id", "=", "role_user.role_id")
            ->first();
        return response()->json($users, 200);

    }

    private function getToken(Request $request)
    {
        try {
            $data = $request->json()->all();
            $dataUser = $data['user'];
            $user = User::where('user_name', $dataUser['user_name'])
                ->orWhere('email', $dataUser['user_name'])
                ->join("role_user", "role_user.user_id", "=", "users.id")
                ->join("roles", "roles.id", "=", "role_user.role_id")
                ->first();
            if ($user && Hash::check($dataUser['password'], $user->password)) {
                return response()->json($user, 200);
            } else {
                return false;
            }
        } catch (NotFoundHttpException  $e) {
            return response()->json('NotFoundHttp', 405);
        } catch (QueryException $e) {
            return response()->json($e, 500);
        } catch (Exception $e) {
            return response()->json('Exception', 500);
        } catch (Error $e) {
            return response()->json('Error', 500);
        }
    }

    function login(Request $request)
    {
        try {
            if ($this->getToken($request) != false) {
                return $this->getToken($request);
            } else {
                return response()->json([], 401);
            }
        } catch (ModelNotFoundException $e) {
            return response()->json('ModelNotFound', 405);
        } catch (NotFoundHttpException  $e) {
            return response()->json('NotFoundHttp', 405);
        } catch (Exception $e) {
            return response()->json('Exception', 500);
        } catch (Error $e) {
            return response()->json('Error', 500);
        }

    }

    function logout(Request $request)
    {
        $data = $request->json()->all();
        $dataUser = $data['user'];
        try {
            User::findOrFail($dataUser['user_id'])->update(['api_token' => str_random(60),]);
            return response()->json([], 201);
        } catch (ModelNotFoundException $e) {
            return response()->json('ModelNotFound', 405);
        } catch (NotFoundHttpException  $e) {
            return response()->json('NotFoundHttp', 405);
        } catch (Exception $e) {
            return response()->json('Exception', 500);
        } catch (Error $e) {
            return response()->json('Error', 500);
        }

    }

    function checkUser(Request $request)
    {
        try {
            $users = User::where('email', '=', $request->email)
                ->join('professionals', 'professionals.user_id', '=', 'users.id')->get();
            return response()->json($users, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json('ModelNotFound', 405);
        } catch (NotFoundHttpException  $e) {
            return response()->json('NotFoundHttp', 405);
        } catch (Exception $e) {
            return response()->json('Exception', 500);
        } catch (Error $e) {
            return response()->json('Error', 500);
        }

    }

    function getAllUsers(Request $request)
    {

        try {
            $users = User::orderby($request->field, $request->order)->paginate($request->limit);
            return response()->json($users, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json('ModelNotFound', 405);
        } catch (NotFoundHttpException  $e) {
            return response()->json('NotFoundHttp', 405);
        } catch (Exception $e) {
            return response()->json('Exception', 500);
        } catch (Error $e) {
            return response()->json('Error', 500);
        }

    }

    function filterUsers(Request $request)
    {
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
            return response()->json('ModelNotFound', 405);
        } catch (NotFoundHttpException  $e) {
            return response()->json('NotFoundHttp', 405);
        } catch (Exception $e) {
            return response()->json('Exception', 500);
        } catch (Error $e) {
            return response()->json('Error', 500);
        }
    }

    function showUser(Request $request)
    {

        try {
            $users = User::findOrFail($request->id);
            return response()->json($users, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json('ModelNotFound', 405);
        } catch (NotFoundHttpException  $e) {
            return response()->json('NotFoundHttp', 405);
        } catch (Exception $e) {
            return response()->json('Exception', 500);
        } catch (Error $e) {
            return response()->json('Error', 500);
        }

    }

    function createProfessionalUser(Request $request)
    {
        try {
            $data = $request->json()->all();
            $dataUser = $data['user'];
            $dataProfessional = $data['professional'];
            DB::beginTransaction();
            $user = User::create([
                'name' => strtoupper($dataUser['name']),
                'user_name' => $dataUser['user_name'],
                'email' => $dataUser['email'],
                'password' => Hash::make($dataUser['password']),
                'api_token' => str_random(60),
            ]);
            $user->roles()->attach(1);
            $user->professional()->create([
                'identity' => $dataProfessional['identity'],
                'first_name' => strtoupper($dataProfessional['first_name']),
                'last_name' => strtoupper($dataProfessional['last_name']),
                'nationality' => strtoupper($dataProfessional['nationality']),
                'civil_status' => strtoupper($dataProfessional['civil_status']),
                'birthdate' => $dataProfessional['birthdate'],
                'gender' => strtoupper($dataProfessional['gender']),
                'phone' => $dataProfessional['phone'],
                'address' => strtoupper($dataProfessional['address']),
                'about_me' => strtoupper($dataProfessional['about_me']),
            ]);
            DB::commit();
            return $this->login($request);
        } catch (ModelNotFoundException $e) {
            return response()->json('ModelNotFound', 405);
        } catch (NotFoundHttpException  $e) {
            return response()->json('NotFoundHttp', 405);
        } catch (QueryException $e) {
            return response()->json($e, 500);
        } catch (Exception $e) {
            return response()->json('Exception', 500);
        } catch (Error $e) {
            return response()->json('Error', 500);
        }
    }

    function createCompanyUser(Request $request)
    {
        try {
            $data = $request->json()->all();
            $dataUser = $data['user'];
            $dataCompany = $data['company'];
            DB::beginTransaction();
            $user = User::create([
                'name' => strtoupper($dataUser['name']),
                'user_name' => $dataUser['user_name'],
                'email' => $dataUser['email'],
                'password' => Hash::make($dataUser['password']),
                'api_token' => str_random(60),
            ]);
            $user->roles()->attach(2);
            $user->company()->create([
                'identity' => $dataCompany['identity'],
                'nature' => $dataCompany['nature'],
                'trade_name' => $dataCompany['trade_name'],
                'comercial_activity' => $dataCompany['comercial_activity'],
                'phone' => $dataCompany['phone'],
                'cell_phone' => $dataCompany['cell_phone'],
                'web_page' => $dataCompany['web_page'],
                'address' => $dataCompany['address'],
            ]);
            DB::commit();
            return $this->login($request);
        } catch (ModelNotFoundException $e) {
            return response()->json('ModelNotFound', 405);
        } catch (NotFoundHttpException  $e) {
            return response()->json('NotFoundHttp', 405);
        } catch (QueryException $e) {
            return response()->json($e, 400);
        } catch (Exception $e) {
            return response()->json('Exception', 500);
        } catch (Error $e) {
            return response()->json('Error', 500);
        }
    }

    function updateUser(Request $request)
    {
        try {
            $data = $request->json()->all();
            $user = User::find($request->id)->update([
                'name' => strtoupper($data['name']),
                'user_name' => $data['user_name'],
                'email' => strtolower($data['email']),
                'password' => Hash::make($data['password']),
                'api_token' => str_random(60),
            ]);
            return response()->json($user, 201);
        } catch (ModelNotFoundException $e) {
            return response()->json('ModelNotFound', 405);
        } catch (NotFoundHttpException  $e) {
            return response()->json('NotFoundHttp', 405);
        } catch (Exception $e) {
            return response()->json('Exception', 500);
        } catch (Error $e) {
            return response()->json('Error', 500);
        }

    }

    function deleteUser(Request $request)
    {

        try {
            $user = User::findOrFail($request->id)->delete();
            return response()->json($user, 201);
        } catch (ModelNotFoundException $e) {
            return response()->json('ModelNotFound', 405);
        } catch (NotFoundHttpException  $e) {
            return response()->json('NotFoundHttp', 405);
        } catch (Exception $e) {
            return response()->json('Exception', 500);
        } catch (Error $e) {
            return response()->json('Error', 500);
        }

    }

}

