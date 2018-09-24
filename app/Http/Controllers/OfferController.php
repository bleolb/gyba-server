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

    function filterOffers2(Request $request)
    {
        $data = $request->json()->all();
        $dataFilter = $data['filter'];
        $offers = Offer::where('code', '=', $dataFilter['code'])
            ->orWhere('broad_field', 'like', $dataFilter['broad_field'] . '%')
            ->orWhere('specific_field', 'like', $dataFilter['specific_field'] . '%')
            ->orWhere('position', 'like', $dataFilter['position'] . '%')
            ->orWhere('province', 'like', $dataFilter['province'] . '%')
            ->orWhere('city', 'like', $dataFilter['city'] . '%')
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

    function filterOffers(Request $request)
    {
        $data = $request->json()->all();
        $dataFilter = $data['filters'];
        $offers = Offer::orWhere($dataFilter['conditions'])
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
