<?php

namespace App\Http\Controllers;

use App\Profesional;
use Illuminate\Http\Request;
Use Exception;
Use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
Use Illuminate\Database\Eloquent\ModelNotFoundException;
use Error;
class ProfesionalController extends Controller
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

    function getAllOffers(Request $request)
    {
        if ($request->isJson()) {
            $profesional = Profesional::findOrFail($request->id);
            $offers = $profesional->offers;
            return response()->json($offers, 200);
        }
        return response()->json(['error' => 'Unathorized'], 401, []);
    }

    function createOffer(Request $request)
    {
        if ($request->isJson()) {
            try {
                $profesional = Profesional::findOrFail($request->profesional_id);
                $response = $profesional->offers()->attach($request->offer_id);
                return response()->json($response, 201);
            } catch (ModelNotFoundException $e1) {
                return response()->json('ModelNotFound', 500);
            } catch (NotFoundHttpException  $e2) {
                return response()->json('NotFoundHttp', 500);
            } catch (Exception $e3) {
                return response()->json('Exception', 500);
            } catch (Error $e4) {
                return response()->json('Error', 500);
            }
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
