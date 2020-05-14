<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\models\User;
use App\Http\JWT\MyJWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Config;

class AuthApi extends Controller
{
    public function test()
    {
        return ['success' => 'true'];
    }

    public function login(Request $request)
    {

        if ($request->input('password') && $request->input('email')) {
            $user = User::where('email', $request->input('email'))->first();

            if ($user && Hash::check($request->input('password'), $user->password)) {
                $jwt = MyJWT::create('HS256');
                $jwt->user_id = $user->id;
                $jwt->exp = time() + (60 * 20);

                $encodedJwtHash = $jwt->encode(Config::get('remote.hash_key'));
                User::where('id', $user->id)->update(['updated_at' => Carbon::now()]);
                $now = Carbon::now();

                return [
                    'isLogged' => true,
                    'token' => $encodedJwtHash,
                    'user_name' => $user->first_name,
                    'exp_time' => (3600*1000*2), // two hours in millisec
                    'success' => true,
                    'message' => null,
                ];
            }
        }
        return [
            'isLogged' => false,
            'token' => null,
            'user_name' => null,
            'success' => false,
            'message' => 'Somthing went wrong',
        ];
    }

    public function subscribe(Request $request)
    {
        if ($request->input('password') && $request->input('email')) {
            $user = new User();
            $user->first_name = $request->input('first_name') ? $request->input('first_name') : '';
            $user->last_name = $request->input('last_name') ? $request->input('last_name') : '';
            $user->email = $request->input('email') ? $request->input('email') : '';
            $user->password = $request->input('password') ? Hash::make($request->input('password')) : '';
            try{
                if($user->save()){
                    return ['success' => true, 'message' => 'Admins will review your request'];
                }
            }
            catch(Exception $e){
                return ['success' => false, 'message' => 'Duplicated entry'];
            }
        } 

        return ['success' => false, 'message' => 'Somthing went wrong'];
    }

    public function logout()
    {

    }
}
