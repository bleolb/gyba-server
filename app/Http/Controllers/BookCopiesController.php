<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class BookCopiesController extends Controller
{
    public function create(Request $request)
    {
        $data = $request->json()->all();
        $sql = "insert into book_copies (book_id, book_code, quantity, state)
                  values(?,?,?,?)";
        $parameters = 
        [$data['book_id'],
         $data['book_code'], 
         $data['quantity'], 
         $data['state']];
        $response = DB::select($sql, $parameters);
        return $response;
    }

    public function update(Request $request)
    {

        $data = $request->json()->all();
        $sql = "update book_copies set 
        book_id = ?,
        book_code=?,
        quantity=?,
        state=? 
        where 
        id =?";
                
        $parameters = 
        [$data['book_id'],
         $data['book_code'], 
         $data['quantity'], 
         $data['state'],
         $data['id']];
        $response = DB::select($sql, $parameters);
        return $response;
    }

    public function delete(Request $request)
    {
        $data = $request->json()->all();
        $sql = "delete from book_copies where id = ?";
                
        $parameters = [$data['id']];
        $response = DB::select($sql, $parameters);
        return $response;
    }
    
}