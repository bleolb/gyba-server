<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ReservationsController extends Controller
{
    public function create(Request $request)
    {
        $data = $request->json()->all();
        $sql = "insert into reservations(code_reservation , date_reservation, date_finish, user_id, book_copy_id)
                  values(?,?,?,?,?)";
        $parameters = 
        [$data['code_reservation'],
         $data['date_reservation'], 
         $data['date_finish'], 
         $data['user_id'],
         $data['book_copy_id']];
        $response = DB::select($sql, $parameters);
        return $response;
    }

    public function update(Request $request)
    {

        $data = $request->json()->all();
        $sql = "update reservations set 
        code_reservation = ?,
        date_reservation=?,
        date_finish=?,
        user_id=?,
        book_copy_id=?
        where 
        id =?";
                
        $parameters = 
        [$data['code_reservation'],
         $data['date_reservation'], 
         $data['date_finish'], 
         $data['user_id'], 
         $data['book_copy_id'],
         $data['id']];
        $response = DB::select($sql, $parameters);
        return $response;
    }

    public function delete(Request $request)
    {
        $data = $request->json()->all();
        $sql = "delete from reservations where id = ?";
                
        $parameters = [$data['id']];
        $response = DB::select($sql, $parameters);
        return $response;
    }

}
