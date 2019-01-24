<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DetailReservationsController extends Controller
{
    public function create(Request $request)
    {
        $data = $request->json()->all();
        $sql = "insert into detail_reservations (reservation_id, book_id, state)
                  values(?,?,?)";
        $parameters = 
        [$data['reservation_id'],
         $data['book_id'], 
         $data['state']];
        $response = DB::select($sql, $parameters);
        return $response;
    }

    public function update(Request $request)
    {

        $data = $request->json()->all();
        $sql = "update detail_reservations set 
        reservation_id = ?,
        book_id=?,
        state=?
        where 
        id =?";
                
        $parameters = 
        [$data['reservation_id'],
         $data['book_id'],
         $data['state'],
         $data['id']];
        $response = DB::select($sql, $parameters);
        return $response;
    }

    public function delete(Request $request)
    {
        $data = $request->json()->all();
        $sql = "delete from detail_reservations where id = ?";
                
        $parameters = [$data['id']];
        $response = DB::select($sql, $parameters);
        return $response;
    }

}