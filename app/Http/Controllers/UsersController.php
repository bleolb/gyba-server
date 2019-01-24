<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function create(Request $request)
    {
        $data = $request->json()->all();
        $sql = "insert into users(first_name,last_name,role,address,phone,email,password,api_token,state)
                  values(?,?,?,?,?,?,?,?,?)";
        $parameters = 
        [$data['first_name'],
         $data['last_name'], 
         $data['role'], 
         $data['address'], 
         $data['phone'],
         $data['email'],
         $data['password'],
         $data['api_token'],
         $data['state']];
        $response = DB::select($sql, $parameters);
        return $response;
    }

    public function update(Request $request)
    {

        $data = $request->json()->all();
        $sql = "update users set 
        first_name = ?,
        last_name=?,
        role=?,
        address=?,
        phone=?,
        email=?,
        password=?,
        api_token=?,
        state=? 
        where 
        id =?";
                
        $parameters = 
        [$data['first_name'],
         $data['last_name'], 
         $data['role'], 
         $data['address'], 
         $data['phone'],
         $data['email'],
         $data['password'],
         $data['api_token'],
         $data['state'],
         $data['id']];
        $response = DB::select($sql, $parameters);
        return $response;
    }

    public function delete(Request $request)
    {
        $data = $request->json()->all();
        $sql = "update users set 
        state=? 
        where 
        id =?";
                
        $parameters = 
        ['DELETE',
         $data['id']];
        $response = DB::select($sql, $parameters);
        return $response;
    }

}
