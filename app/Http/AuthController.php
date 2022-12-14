<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(RegisterRequest $request){

        $user = User::create([
            'role_id'=>'2',
            'name'=>$request->input('name'),
            'email'=>$request->input('email'),
            'avatar'=>$request->input('avatar'),
            'phone_number'=>$request->input('phone_number'),
            'password'=>Hash::make($request->input('password')),

        ]);
        //$user->phone_number = $request->input('phone_number');

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token,
        ];

        return response($response, 200);

    }

    public function login(Request $request){


        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string ',
        ]);

        // Check email
        $user = User::where('email',$fields['email'] )->first();

        // Check passwords
        if(!$user || !Hash::check($fields['password'],$user->password)){

            return response(['message' =>'Bad creds'],401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token,
        ];

        return response($response, 201);
    }

    public function user(Request $request){

        return $request->user();
    }
    public function logout(){

        $cookie=Cookie::forget('token');

        return \response([
            'message'=>'success'
        ])->withCookie($cookie);

    }
}
