<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SanctionsController extends Controller
{
    public function create(Request $request)
    {
        $data = $request->json()->all();
        $sql = "insert into sanctions(book_id, user_id, type, state)
                  values(?,?,?,?)";
        $parameters = 
        [$data['book_id'],
         $data['user_id'], 
         $data['type'],
         $data['state']];
        $response = DB::select($sql, $parameters);
        return $response;
    }

    public function delete(Request $request)
    {
        $data = $request->json()->all();
        $sql = "update sanctions set 
        state=? 
        where 
        id =?";
                
        $parameters = 
        ['DELETE', //VERIFICAR CON EL TEAM
         $data['id']];
        $response = DB::select($sql, $parameters);
        return $response;
    }
}