<?php

namespace App\Http\Controllers;

class CompanyController extends Controller
{
    function getAllOffers(Request $request)
    {
        if ($request->isJson()) {
            $companies = Company::orderby($request->field, $request->order)->paginate($request->limit);
            return response()->json($companies, 200);
        }
        return response()->json(['error' => 'Unsupported Media Type'], 415, []);
    }

    function filterOffers(Request $request)
    {
        if ($request->isJson()) {
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
        return response()->json(['error' => 'Unsupported Media Type'], 415, []);
    }

    function getAllCompanies(Request $request)
    {
        if ($request->isJson()) {
            $companies = Company::orderby($request->field, $request->order)->paginate($request->limit);
            return response()->json($companies, 200);
        }
        return response()->json(['error' => 'Unsupported Media Type'], 415, []);
    }

    function filterCompanies(Request $request)
    {
        if ($request->isJson()) {
            //para tener varias condiciones en un array
            //$companies = Company::orWhere([$request->conditions])
            $data = $request->json()->all();
            $companies = Company::orWhere('name', 'like', $data['name'] . '%')
                ->orWhere('user_name', 'like', $data['user_name'] . '%')
                ->orWhere('email', 'like', $data['email'] . '%')
                ->orderby($request->field, $request->order)->paginate($request->limit);
            return response()->json($companies, 200);
        }
        return response()->json(['error' => 'Unsupported Media Type'], 415, []);
    }

    function showCompany($id)
    {
        $companies = Company::find($id);
        return response()->json($companies, 200);
    }

    function createCompany(Request $request)
    {
        if ($request->isJson()) {
            $data = $request->json()->all();
            $company = Company::create([
                'identity' => $data['name'],
                'type' => $data['user_name'],
                'email' => $data['email'],
                'activity' => $data['activity'],
                'trade_name' => $data['trade_name'],
                'comercial_activity' => $data['comercial_activity'],
                'phone' => $data['phone'],
                'cell_phone' => $data['cell_phone'],
                'web_page' => $data['web_page'],
                'address' => $data['address'],
            ]);
            return response()->json($company, 201);
        }
        return response()->json(['error' => 'Unsupported Media Type'], 415, []);
    }

    function updateCompany(Request $request)
    {
        if ($request->isJson()) {
            $data = $request->json()->all();
            $user = Company::find($data['id'])->update([
                'identity' => $data['name'],
                'type' => $data['user_name'],
                'email' => $data['email'],
                'activity' => $data['activity'],
                'trade_name' => $data['trade_name'],
                'comercial_activity' => $data['comercial_activity'],
                'phone' => $data['phone'],
                'cell_phone' => $data['cell_phone'],
                'web_page' => $data['web_page'],
                'address' => $data['address'],
            ]);
            return response()->json($user, 201);
        }
        return response()->json(['error' => 'Unsupported Media Type'], 415, []);
    }

    function deleteCompany(Request $request)
    {
        $user = Company::findOrFail($request->id)->delete();
        return response()->json($user, 201);
    }
}
