<?php

namespace App\Http\Controllers;

use App\Company;
use App\Offer;
use App\Professional;
use App\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    function getOffers(Request $request)
    {
        try {
            $company = Company::where('user_id', $request->id)->first();
            $offers = $company->offers()
                ->where('status', '1')
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
        } catch (ModelNotFoundException $e) {
            return response()->json($e, 405);
        } catch (NotFoundHttpException  $e) {
            return response()->json($e, 405);
        } catch (QueryException  $e) {
            return response()->json($e, 405);
        } catch (Exception $e) {
            return response()->json($e, 500);
        } catch (Error $e) {
            return response()->json($e, 500);
        }
    }

    function getProfessionals(Request $request)
    {
        try {
            $offer = Offer::findOrFail($request->offer_id);
            $professionals = $offer->professionals()
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
                ], 'professionals' => $professionals], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json($e, 405);
        } catch (NotFoundHttpException  $e) {
            return response()->json($e, 405);
        } catch (QueryException  $e) {
            return response()->json($e, 405);
        } catch (Exception $e) {
            return response()->json($e, 500);
        } catch (Error $e) {
            return response()->json($e, 500);
        }
    }

    function filterOffers(Request $request)
    {
        try {
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
        } catch (ModelNotFoundException $e) {
            return response()->json($e, 405);
        } catch (NotFoundHttpException  $e) {
            return response()->json($e, 405);
        } catch (QueryException  $e) {
            return response()->json($e, 405);
        } catch (Exception $e) {
            return response()->json($e, 500);
        } catch (Error $e) {
            return response()->json($e, 500);
        }

    }

    function showCompany($id)
    {
        try {
            $company = Company::where('user_id', $id)->first();
            return response()->json(['company' => $company], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json($e, 405);
        } catch (NotFoundHttpException  $e) {
            return response()->json($e, 405);
        } catch (QueryException  $e) {
            return response()->json($e, 405);
        } catch (Exception $e) {
            return response()->json($e, 500);
        } catch (Error $e) {
            return response()->json($e, 500);
        }
    }

    function createOffer(Request $request)
    {
        try {
            $data = $request->json()->all();
            $dataOffer = $data['offer'];
            $dataCompany = $data['company'];
            $company = Company::where('user_id', $dataCompany['id'])->first();
            $response = $company->offers()->create([
                'code' => $dataOffer ['code'],
                'contact' => $dataOffer ['contact'],
                'email' => $dataOffer ['email'],
                'phone' => $dataOffer ['phone'],
                'cell_phone' => $dataOffer ['cell_phone'],
                'contract_type' => $dataOffer ['contract_type'],
                'position' => $dataOffer ['position'],
                'broad_field' => $dataOffer ['broad_field'],
                'specific_field' => $dataOffer ['specific_field'],
                'training_hours' => $dataOffer ['training_hours'],
                'experience_time' => $dataOffer ['experience_time'],
                'remuneration' => $dataOffer ['remuneration'],
                'working_day' => $dataOffer ['working_day'],
                'number_jobs' => $dataOffer ['number_jobs'],
                'start_date' => $dataOffer ['start_date'],
                'finish_date' => $dataOffer ['finish_date'],
                'activities' => $dataOffer ['activities'],
                'aditional_information' => $dataOffer ['aditional_information'],
                'province' => $dataOffer ['province'],
                'city' => $dataOffer ['city'],
            ]);
            return response()->json($response, 201);
        } catch (ModelNotFoundException $e) {
            return response()->json($e, 405);
        } catch (NotFoundHttpException  $e) {
            return response()->json($e, 405);
        } catch (QueryException  $e) {
            return response()->json($e, 405);
        } catch (Exception $e) {
            return response()->json($e, 500);
        } catch (Error $e) {
            return response()->json($e, 500);
        }
    }

    function updateOffer(Request $request)
    {
        try {
            $data = $request->json()->all();
            $dataOffer = $data['offer'];
            $response = Offer::findOrFail($dataOffer['id'])->update([
                'code' => $dataOffer ['code'],
                'contact' => $dataOffer ['contact'],
                'email' => $dataOffer ['email'],
                'phone' => $dataOffer ['phone'],
                'cell_phone' => $dataOffer ['cell_phone'],
                'contract_type' => $dataOffer ['contract_type'],
                'position' => $dataOffer ['position'],
                'broad_field' => $dataOffer ['broad_field'],
                'specific_field' => $dataOffer ['specific_field'],
                'training_hours' => $dataOffer ['training_hours'],
                'experience_time' => $dataOffer ['experience_time'],
                'remuneration' => $dataOffer ['remuneration'],
                'working_day' => $dataOffer ['working_day'],
                'number_jobs' => $dataOffer ['number_jobs'],
                'start_date' => $dataOffer ['start_date'],
                'finish_date' => $dataOffer ['finish_date'],
                'activities' => $dataOffer ['activities'],
                'aditional_information' => $dataOffer ['aditional_information'],
                'province' => $dataOffer ['province'],
                'city' => $dataOffer ['city'],
            ]);
            return response()->json($response, 201);
        } catch (ModelNotFoundException $e) {
            return response()->json('ModelNotFound', 405);
        } catch (NotFoundHttpException  $e) {
            return response()->json('NotFoundHttp', 405);
        } catch (QueryException  $e) {
            return response()->json($e, 405);
        } catch (Exception $e) {
            return response()->json('Exception', 500);
        } catch (Error $e) {
            return response()->json('Error', 500);
        }
    }

    function updateCompany(Request $request)
    {
        try {
            $data = $request->json()->all();
            $dataCompany = $data['company'];
            $response = Company::findOrFail($dataCompany['id'])->update([
                'identity' => $dataCompany['identity'],
                'nature' => $dataCompany['nature'],
                'trade_name' => $dataCompany['trade_name'],
                'comercial_activity' => $dataCompany['comercial_activity'],
                'phone' => $dataCompany['phone'],
                'cell_phone' => $dataCompany['cell_phone'],
                'web_page' => $dataCompany['web_page'],
                'address' => $dataCompany['address'],
            ]);
            return response()->json($response, 201);
        } catch (ModelNotFoundException $e) {
            return response()->json($e, 405);
        } catch (NotFoundHttpException  $e) {
            return response()->json($e, 405);
        } catch (QueryException  $e) {
            return response()->json($e, 405);
        } catch (Exception $e) {
            return response()->json($e, 500);
        } catch (Error $e) {
            return response()->json($e, 500);
        }
    }

    function deleteCompany(Request $request)
    {
        try {
            $offer = Offer::findOrFail($request->id)->delete();
            return response()->json($offer, 201);
        } catch (ModelNotFoundException $e) {
            return response()->json($e, 405);
        } catch (NotFoundHttpException  $e) {
            return response()->json($e, 405);
        } catch (QueryException  $e) {
            return response()->json($e, 405);
        } catch (Exception $e) {
            return response()->json($e, 500);
        } catch (Error $e) {
            return response()->json($e, 500);
        }
    }

}
