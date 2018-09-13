<?php

namespace App\Http\Controllers;

use App\Offer;
use Illuminate\Http\Request;

class OfferController extends Controller
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

    function getAllProfesionals(Request $request)
    {
        if ($request->isJson()) {
            $offer = Offer::findOrFail($request->id);
            $profesionals = $offer->profesionals;
            return response()->json($profesionals, 200);
        }
        return response()->json(['error' => 'Unathorized'], 401, []);
    }

    function createOfferProfesional(Request $request)
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

    function updateOfferProfesional(Request $request, $id)
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

    function deleteOfferProfesional($id)
    {
        $user = User::findOrFail($id)->delete();
        return response()->json($user, 201);
    }
}
