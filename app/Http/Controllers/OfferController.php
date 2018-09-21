<?php

namespace App\Http\Controllers;

use App\Company;
use App\Offer;
use App\User;
use Illuminate\Http\Request;

class OfferController extends Controller
{

    function getAllOffers(Request $request)
    {
        $offers = Offer::orderby($request->field, $request->order)->paginate($request->limit);
        return response()->json($offers, 200);

    }

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

    function createOffer(Request $request)
    {

        $data = $request->json()->all();
        $company = Company::findOrFail($request->company_id);
        $response = $company->offers()->create([
            'code' => $data['code']
        ]);
        return response()->json($response, 201);

    }

    function updateOffer(Request $request)
    {

        $data = $request->json()->all();
        $offer = Offer::find($request->id)->update([
            'code' => $data['code']
        ]);
        return response()->json($offer, 201);

    }

    function deleteOffer(Request $request)
    {
        $offer = Offer::findOrFail($request->id)->delete();
        return response()->json($offer, 201);
    }
}
