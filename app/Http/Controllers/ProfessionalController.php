<?php

namespace App\Http\Controllers;

use App\Professional;
use App\Language;
use App\Offer;
use Illuminate\Http\Request;
Use Exception;
Use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
Use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProfessionalController extends Controller
{
    function filterOffers(Request $request)
    {

        //para tener varias condiciones en un array
        //$users = User::orWhere([$request->conditions])
        $data = $request->json()->all();
        $offers = Offer::orWhere('broad_field', 'like', $data['broad_field'] . '%')
            ->orWhere('specific_field', 'like', $data['specific_field'] . '%')
            ->orWhere('position', 'like', $data['position'] . '%')
            ->orWhere('remuneration', 'like', $data['remuneration'] . '%')
            ->orWhere('working_day', 'like', $data['working_day'] . '%')
            ->orderby($request->field, $request->order)
            ->paginate($request->limit);
        return response()->json([
            'pagination' => [
                'total' => $offers->total(),
                'current_page' => $offers->currentPage(),
                'per_page' => $offers->perPage(),
                'last_page' => $offers->lastPage(),
                'from' => $offers->firstItem(),
                'to' => $offers->lastItem()
            ], 'offers' => $offers], 200);

    }

    /* Metodo para obtener todas las ofertas a las que aplico el profesional*/
    function getAllOffers(Request $request)
    {

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

    /* Metodo para filtrar a los profesionales*/
    function filterProfessionals(Request $request)
    {

        $data = $request->json()->all();
        $professionals = Professional::
        join('academic_formations', 'academic_formations.professional_id', '=', 'professionals.id')
            ->orWhere('academic_formations.professional_degree', 'like', $data['professional_degree'] . '%')
            ->orWhere('academic_formations.professional_degree', 'like', $data['professional_degree'] . '%')
            ->get();
        return $professionals;
        $professionals = Professional::orWhere('broad_field', 'like', $data['broad_field'] . '%')
            ->orWhere('specific_field', 'like', $data['specific_field'] . '%')
            ->orWhere('position', 'like', $data['position'] . '%')
            ->orWhere('remuneration', 'like', $data['remuneration'] . '%')
            ->orWhere('working_day', 'like', $data['working_day'] . '%')
            ->orderby($request->field, $request->order)
            ->paginate($request->limit);
        return response()->json([
            'pagination' => [
                'total' => $professionals->total(),
                'current_page' => $professionals->currentPage(),
                'per_page' => $professionals->perPage(),
                'last_page' => $professionals->lastPage(),
                'from' => $professionals->firstItem(),
                'to' => $professionals->lastItem()
            ], 'offers' => $professionals], 200);

    }

    /* Metodo para asignar ofertas a un profesional*/
    function createOffer(Request $request)
    {

        try {
            $professional = Professional::findOrFail($request->professional_id);
            $response = $professional->offers()->attach($request->offer_id);
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

    /* Metodos para gestionar los datos personales*/
    function createProfessional(Request $request)
    {

        try {
            $data = $request->json()->all();
            $professional = Professional::create([
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
            return response()->json($professional, 201);
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

    function updateProfessional(Request $request)
    {

        try {
            $data = $request->json()->all();
            $professional = Professional::find($data['id'])->update([
                'identity' => $data['name'],
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'nationality' => $data['nationality'],
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
            return response()->json('ModelNotFound', 405);
        } catch (NotFoundHttpException  $e) {
            return response()->json('NotFoundHttp', 405);
        } catch (Exception $e) {
            return response()->json('Exception', 500);
        } catch (Error $e) {
            return response()->json('Error', 500);
        }

    }

    function deleteProfessional(Request $request)
    {
        try {
            $professional = Professional::findOrFail($request->id)->delete();
            return response()->json($professional, 201);
        } catch (ModelNotFoundException $e) {
            return response()->json('ModelNotFound', 405);
        } catch (NotFoundHttpException  $e) {
            return response()->json('NotFoundHttp', 405);
        } catch (Exception $e) {
            return response()->json('Exception', 500);
        } catch (Error $e) {
            return response()->json('Error', 500);
        }
        return response()->json(['error' => 'Unsupported Media Type'], 415, []);
    }

}
