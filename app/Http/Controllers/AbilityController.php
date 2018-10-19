<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Professional;
use App\Ability;

class AbilityController extends Controller
{
    function getAbilities(Request $request)
    {
        try {
            $professional = Professional::where('user_id', $request->user_id)->first();
            if ($professional) {
                $abilities = Ability::where('professional_id', $professional->id)
                    ->orderby($request->field, $request->order)
                    ->paginate($request->limit);
                return response()->json([
                    'pagination' => [
                        'total' => $abilities->total(),
                        'current_page' => $abilities->currentPage(),
                        'per_page' => $abilities->perPage(),
                        'last_page' => $abilities->lastPage(),
                        'from' => $abilities->firstItem(),
                        'to' => $abilities->lastItem()
                    ], 'abilities' => $abilities], 200);
            } else {
                return response()->json([
                    'pagination' => [
                        'total' => 0,
                        'current_page' => 1,
                        'per_page' => $request->limit,
                        'last_page' => 1,
                        'from' => null,
                        'to' => null
                    ], 'abilities' => null], 404);
            }
        } catch (ModelNotFoundException $e) {
            return response()->json($e, 405);
        } catch (NotFoundHttpException  $e) {
            return response()->json($e, 405);
        } catch (QueryException $e) {
            return response()->json($e, 400);
        } catch (Exception $e) {
            return response()->json($e, 500);
        } catch (Error $e) {
            return response()->json($e, 500);
        } catch (ErrorException $e) {
            return response()->json($e, 500);
        }
    }

    function showAbility($id)
    {
        try {
            $ability = Ability::findOrFail($id);
            return response()->json(['ability' => $ability], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json($e, 405);
        } catch (NotFoundHttpException  $e) {
            return response()->json($e, 405);
        } catch (QueryException $e) {
            return response()->json($e, 400);
        } catch (Exception $e) {
            return response()->json($e, 500);
        } catch (Error $e) {
            return response()->json($e, 500);
        }
    }

    function createAbility(Request $request)
    {
        try {
            $data = $request->json()->all();
            $dataUser = $data['user'];
            $dataAbility = $data['ability'];
            $professional = Professional::where('user_id', $dataUser['id'])->first();
            if($professional){
            $response = $professional->abilities()->create([
                'category' => $dataAbility ['category'],
                'description' => $dataAbility ['description'],
            ]);
            return response()->json($response, 201);
            }else{
                return response()->json(null, 404);
            }
        } catch (ModelNotFoundException $e) {
            return response()->json($e, 405);
        } catch (NotFoundHttpException  $e) {
            return response()->json($e, 405);
        } catch (QueryException $e) {
            return response()->json($e, 400);
        } catch (Exception $e) {
            return response()->json($e, 500);
        } catch (Error $e) {
            return response()->json($e, 500);
        }
    }

    function updateAbility(Request $request)
    {
        try {
            $data = $request->json()->all();
            $dataAbility = $data['ability'];
            $ability = Ability::findOrFail($dataAbility ['id'])->update([
                'category' => $dataAbility ['category'],
                'description' => $dataAbility ['description'],
            ]);
            return response()->json($ability, 201);
        } catch (ModelNotFoundException $e) {
            return response()->json($e, 405);
        } catch (NotFoundHttpException  $e) {
            return response()->json($e, 405);
        } catch (QueryException $e) {
            return response()->json($e, 400);
        } catch (Exception $e) {
            return response()->json($e, 500);
        } catch (Error $e) {
            return response()->json($e, 500);
        }
    }

    function deleteAbility(Request $request)
    {
        try {
            $ability = Ability::findOrFail($request->id)->delete();
            return response()->json($ability, 201);
        } catch (ModelNotFoundException $e) {
            return response()->json($e, 405);
        } catch (NotFoundHttpException  $e) {
            return response()->json($e, 405);
        } catch (QueryException $e) {
            return response()->json($e, 400);
        } catch (Exception $e) {
            return response()->json($e, 500);
        } catch (Error $e) {
            return response()->json($e, 500);
        }
    }
}