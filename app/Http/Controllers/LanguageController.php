<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Language;
use App\Professional;

class LanguageController extends Controller
{
    function getAllLanguages(Request $request)
    {

            try {
                $languages = Language::orderby($request->field, $request->order)->paginate($request->limit);
                return response()->json([
                    'pagination' => [
                        'total' => $languages->total(),
                        'current_page' => $languages->currentPage(),
                        'per_page' => $languages->perPage(),
                        'last_page' => $languages->lastPage(),
                        'from' => $languages->firstItem(),
                        'to' => $languages->lastItem()
                    ], 'languages' => $languages], 200);
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

    function showLanguage($id)
    {
        try {
            $language = Language::findOrFail($id);
            return response()->json($language, 200);
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

    function createLanguage(Request $request)
    {

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
                return response()->json('ModelNotFound', 405);
            } catch (NotFoundHttpException  $e) {
                return response()->json('NotFoundHttp', 405);
            } catch (Exception $e) {
                return response()->json('Exception', 500);
            } catch (Error $e) {
                return response()->json('Error', 500);
            }

    }

    function updateLanguage(Request $request)
    {

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
                return response()->json('ModelNotFound', 405);
            } catch (NotFoundHttpException  $e) {
                return response()->json('NotFoundHttp', 405);
            } catch (Exception $e) {
                return response()->json('Exception', 500);
            } catch (Error $e) {
                return response()->json('Error', 500);
            }

    }

    function deleteLanguage(Request $request)
    {

            try {
                $language = Language::findOrFail($request->id)->delete();
                return response()->json($language, 201);
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
