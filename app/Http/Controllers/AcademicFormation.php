<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Professional;

class AcademicFormation extends Controller
{
    function getAllAcademicFormations(Request $request)
    {

            try {
                $academicFormations = AcademicFormation::orderby($request->field, $request->order)->paginate($request->limit);
                return response()->json([
                    'pagination' => [
                        'total' => $academicFormations->total(),
                        'current_page' => $academicFormations->currentPage(),
                        'per_page' => $academicFormations->perPage(),
                        'last_page' => $academicFormations->lastPage(),
                        'from' => $academicFormations->firstItem(),
                        'to' => $academicFormations->lastItem()
                    ], 'academicFormations' => $academicFormations], 200);
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

    function showAcademicFormation($id)
    {
        try {
            $academicFormation = AcademicFormation::findOrFail($id);
            return response()->json($academicFormation, 200);
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

    function createAcademicFormation(Request $request)
    {

            try {
                $data = $request->json()->all();
                $professional = Professional::findOrFail($request->professional_id);
                $response = $professional->academicFormations()->create([
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

    function updateAcademicFormation(Request $request)
    {

            try {
                $data = $request->json()->all();
                $academicFormation = AcademicFormation::findOrFail($data['id'])->update([
                    'description' => $data['description'],
                    'written_level' => $data['written_level'],
                    'spoken_level' => $data['spoken_level'],
                    'reading_level' => $data['reading_level'],
                ]);
                return response()->json($academicFormation, 201);
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

    function deleteAcademicFormation(Request $request)
    {

            try {
                $academicFormation = AcademicFormation::findOrFail($request->id)->delete();
                return response()->json($academicFormation, 201);
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
