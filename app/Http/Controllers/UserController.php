<?php

namespace App\Http\Controllers;

use App\models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getAllUsers(Request $request){
        $response = [];
        if($request->loggedUser){
            $response = User::select('*')->get();
        }
        return $response;
    }
}
