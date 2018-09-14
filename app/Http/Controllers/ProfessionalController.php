<?php

namespace App\Http\Controllers;

use App\Professional;
use App\Language;
use Illuminate\Http\Request;
Use Exception;
Use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
Use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProfessionalController extends Controller
{
    /*Metodo para obtener todas las ofertas a las que aplico el profesional*/
    function getAllOffers(Request $request)
    {
        if ($request->isJson()) {
            try {
                $professional = Professional::findOrFail($request->professional_id);
                $offers = $professional->offers;
                return response()->json($offers, 200);
            } catch (ModelNotFoundException $e) {
                return response()->json("ModelNotFoundException", 204);
            } catch (NotFoundHttpException $e) {
                return response()->json("NotFoundHttpException", 204);
            } catch (Exception $e) {
                return response()->json("Exception", 500);
            } catch (Error $e) {
                return response()->json("Error", 500);
            }

        }
        return response()->json(['error' => 'Unsupported Media Type'], 415, []);
    }

    /*Fin Metodo para obtener todas las ofertas a las que aplico el profesional*/

    function createOffer(Request $request)
    {
        if ($request->isJson()) {
            try {
                $professional = Professional::findOrFail($request->professional_id);
                $response = $professional->offers()->attach($request->offer_id);
                return response()->json($response, 201);
            } catch (ModelNotFoundException $e) {
                return response()->json('ModelNotFound', 204);
            } catch (NotFoundHttpException  $e) {
                return response()->json('NotFoundHttp', 204);
            } catch (Exception $e) {
                return response()->json('Exception', 500);
            } catch (Error $e) {
                return response()->json('Error', 500);
            }
        }
        return response()->json(['error' => 'Unsupported Media Type'], 415, []);
    }

    function updateOfferProfessional(Request $request)
    {
        if ($request->isJson()) {
            try {
                $data = $request->json()->all();
                $professional = User::find($data['id'])->update([
                    'name' => $data['name'],
                    'user_name' => $data['user_name'],
                    'email' => $data['email'],
                    'password' => Hash::make($data['password']),
                    'api_token' => str_random(60),
                ]);
                return response()->json($professional, 201);
            } catch (ModelNotFoundException $e) {
                return response()->json('ModelNotFound', 204);
            } catch (NotFoundHttpException  $e) {
                return response()->json('NotFoundHttp', 204);
            } catch (Exception $e) {
                return response()->json('Exception', 500);
            } catch (Error $e) {
                return response()->json('Error', 500);
            }
        }
        return response()->json(['error' => 'Unsupported Media Type'], 415, []);
    }

    function deleteOfferProfessional($id)
    {
        $professional = User::findOrFail($id)->delete();
        return response()->json($professional, 201);
    }

    /*Metodos para gestionar los datos personales*/
    function createProfessional(Request $request)
    {
        if ($request->isJson()) {
            try {
                $data = $request->json()->all();
                $professional = Professional::create([
                    'identity' => $data['name'],
                    'first_name' => $data['first_name'],
                    'last_name' => $data['last_name'],
                    'nationality' => $data['nationality'],
                    'email' => $data['email'],
                    'civil_status' => $data['civil_status'],
                    'birthdate' => $data['birthdate'],
                    'gender' => $data['gender'],
                    'phone' => $data['phone'],
                    'cell_phone' => $data['cell_phone'],
                    'address' => $data['address'],
                    'about_me' => $data['web_page'],
                ]);
                return response()->json($professional, 201);
            } catch (ModelNotFoundException $e) {
                return response()->json('ModelNotFound', 204);
            } catch (NotFoundHttpException  $e) {
                return response()->json('NotFoundHttp', 204);
            } catch (Exception $e) {
                return response()->json('Exception', 500);
            } catch (Error $e) {
                return response()->json('Error', 500);
            }
        }
        return response()->json(['error' => 'Unsupported Media Type'], 415, []);
    }

    function updateProfessional(Request $request)
    {
        if ($request->isJson()) {
            try {
                $data = $request->json()->all();
                $professional = Professional::find($data['id'])->update([
                    'identity' => $data['name'],
                    'first_name' => $data['first_name'],
                    'last_name' => $data['last_name'],
                    'nationality' => $data['nationality'],
                    'email' => $data['email'],
                    'civil_status' => $data['civil_status'],
                    'birthdate' => $data['birthdate'],
                    'gender' => $data['gender'],
                    'phone' => $data['phone'],
                    'cell_phone' => $data['cell_phone'],
                    'address' => $data['address'],
                    'about_me' => $data['web_page'],
                ]);
                return response()->json($professional, 201);
            } catch (ModelNotFoundException $e) {
                return response()->json('ModelNotFound', 204);
            } catch (NotFoundHttpException  $e) {
                return response()->json('NotFoundHttp', 204);
            } catch (Exception $e) {
                return response()->json('Exception', 500);
            } catch (Error $e) {
                return response()->json('Error', 500);
            }
        }
        return response()->json(['error' => 'Unsupported Media Type'], 415, []);
    }

    function deleteProfessional(Request $request)
    {
        if ($request->isJson()) {
            try {
                $professional = Professional::findOrFail($request->id)->delete();
                return response()->json($professional, 201);
            } catch (ModelNotFoundException $e) {
                return response()->json('ModelNotFound', 204);
            } catch (NotFoundHttpException  $e) {
                return response()->json('NotFoundHttp', 204);
            } catch (Exception $e) {
                return response()->json('Exception', 500);
            } catch (Error $e) {
                return response()->json('Error', 500);
            }
            return response()->json(['error' => 'Unsupported Media Type'], 415, []);
        }
    }
    /*Fin Metodos para gestionar los datos personales*/

    /*Metodos para gestionar los idiomas*/
    function getAllLanguages(Request $request)
    {
        if ($request->isJson()) {
            try {
                $languages = Language::orderby($request->field, $request->order)->paginate($request->limit);
                return response()->json($languages, 200);
            } catch (ModelNotFoundException $e) {
                return response()->json('ModelNotFound', 204);
            } catch (NotFoundHttpException  $e) {
                return response()->json('NotFoundHttp', 204);
            } catch (Exception $e) {
                return response()->json('Exception', 500);
            } catch (Error $e) {
                return response()->json('Error', 500);
            }
        }
        return response()->json(['error' => 'Unsupported Media Type'], 415, []);
    }

    function showLanguage($id)
    {
        $language = Language::find($id);
        return response()->json($language, 200);
    }

    function createLanguage(Request $request)
    {
        if ($request->isJson()) {
            try {
                $data = $request->json()->all();
                $professional = Professional::findOrFail($request->professional_id);
                $response = $professional->languages()->create([
                    'description' => $data['description'],
                    'written_level' => $data['written_level'],
                    'spoken_level' => $data['spoken_level'],
                    'reading_level' => $data['reading_level'],
                ]);
                return response()->json($response, 201);
            } catch (ModelNotFoundException $e) {
                return response()->json('ModelNotFound', 204);
            } catch (NotFoundHttpException  $e) {
                return response()->json('NotFoundHttp', 204);
            } catch (Exception $e) {
                return response()->json('Exception', 500);
            } catch (Error $e) {
                return response()->json('Error', 500);
            }
        }
        return response()->json(['error' => 'Unsupported Media Type'], 415, []);
    }

    function updateLanguage(Request $request)
    {
        if ($request->isJson()) {
            try {
                $data = $request->json()->all();
                $language = Language::findOrFail($data['id'])->update([
                    'description' => $data['description'],
                    'written_level' => $data['written_level'],
                    'spoken_level' => $data['spoken_level'],
                    'reading_level' => $data['reading_level'],
                ]);
                return response()->json($language, 201);
            } catch (ModelNotFoundException $e) {
                return response()->json('ModelNotFound', 204);
            } catch (NotFoundHttpException  $e) {
                return response()->json('NotFoundHttp', 204);
            } catch (Exception $e) {
                return response()->json('Exception', 500);
            } catch (Error $e) {
                return response()->json('Error', 500);
            }
        }
        return response()->json(['error' => 'Unsupported Media Type'], 415, []);
    }

    function deleteLanguage(Request $request)
    {
        if ($request->isJson()) {
            try {
                $language = Language::findOrFail($request->id)->delete();
                return response()->json($language, 201);
            } catch (ModelNotFoundException $e) {
                return response()->json('ModelNotFound', 204);
            } catch (NotFoundHttpException  $e) {
                return response()->json('NotFoundHttp', 204);
            } catch (Exception $e) {
                return response()->json('Exception', 500);
            } catch (Error $e) {
                return response()->json('Error', 500);
            }
        }
        return response()->json(['error' => 'Unsupported Media Type'], 415, []);
    }
    /* Fin Metodos para gestionar los idiomas*/

}
