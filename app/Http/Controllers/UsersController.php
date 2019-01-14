<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
        function prueba(){
            $id = 1;
            $sql = 'select * from users where id = '.$id;
            $response = DB::select($sql);
            return $response;
        }
}
