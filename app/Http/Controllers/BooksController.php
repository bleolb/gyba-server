<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class BooksController extends Controller
{
        function show(Request $request){ //devolver un unico efecto
            $sql = 'select * from books where id = ?';
            $parameters = [$request->id];
            $response = DB::select($sql, $parameters);
            if($response==true){
                return response()->json(['response'=>$response[0]]);
            }else{
                return response()->json(['response'=>false]);
            }
            
        }

        function getAll(Request $request){ //devolver un unico efecto
            $sql = 'select * from books';
            $response = DB::select($sql);
            if($response==true){
                return response()->json(['response'=>$response]);
            }else{
                return response()->json(['response'=>false]);
            }
            
        }
}
