<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Professional;

class CourseController extends Controller
{
    function getAllCourses(Request $request)
    {
        if ($request->isJson()) {
            try {
                $courses = Course::orderby($request->field, $request->order)->paginate($request->limit);
                return response()->json([
                    'pagination' => [
                        'total' => $courses->total(),
                        'current_page' => $courses->currentPage(),
                        'per_page' => $courses->perPage(),
                        'last_page' => $courses->lastPage(),
                        'from' => $courses->firstItem(),
                        'to' => $courses->lastItem()
                    ], 'courses' => $courses], 200);
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

    function showCourse($id)
    {
        try {
            $course = Course::findOrFail($id);
            return response()->json($course, 200);
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

    function createCourse(Request $request)
    {
        if ($request->isJson()) {
            try {
                $data = $request->json()->all();
                $professional = Professional::findOrFail($request->professional_id);
                $response = $professional->courses()->create([
                    'description' => $data['description'],
                    'written_level' => $data['written_level'],
                    'spoken_level' => $data['spoken_level'],
                    'reading_level' => $data['reading_level'],
                ]);
                return response()->json($response, 201);
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

    function updateCourse(Request $request)
    {
        if ($request->isJson()) {
            try {
                $data = $request->json()->all();
                $course = Course::findOrFail($data['id'])->update([
                    'description' => $data['description'],
                    'written_level' => $data['written_level'],
                    'spoken_level' => $data['spoken_level'],
                    'reading_level' => $data['reading_level'],
                ]);
                return response()->json($course, 201);
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

    function deleteCourse(Request $request)
    {
        if ($request->isJson()) {
            try {
                $course = Course::findOrFail($request->id)->delete();
                return response()->json($course, 201);
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