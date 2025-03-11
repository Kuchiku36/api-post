<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthApiController extends Controller
{
    //
    public function register(Request $request)

    {
        // demande de donné conforme 
        $rqUser= $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required',
        ]);
        $user = User::create($rqUser) ;
//création du token de l'utilisateur
        $token = $user->createToken($request->name);

        return [
            'user' => $user,
            'token' => $token->plainTextToken,
        ];
    }// end register

    public function login(Request $request)

    {
        $rqUser= $request->validate([
            'email'=>'required|email',
            'password'=>'required',
        ]);
        $user = User::where('email',$request->email)->first() ;

        if(!$user || !Hash::check($request->password, $user->password)){
            return [
                'error'=>'error'
            ];
        }
//création du token de l'utilisateur
        $token = $user->createToken($user->name);

        return [
            'user' => $user,
            'token' => $token->plainTextToken,
        ];
    }// end login

    public function logout(Request $request)

    {
        $request->user()->tokens()->delete();
        return ['logout' => true];
    }// end logout
}
