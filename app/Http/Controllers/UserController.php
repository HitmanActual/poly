<?php

namespace App\Http\Controllers;
use App\Traits\ResponseTrait;
use App\User;
use Illuminate\Http\Response;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    use ResponseTrait;
    public function register(Request $request){

        $validateData = $request->validate([
            'name' => 'required|max:55',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required',
            'country_id'=>'required',
            'age'=>'required',
            'mode_id'=>'required',
            'level_id'=>'required',
            'language_id'=>'required',


        ]);

        $validateData['password'] = bcrypt($request->password);

        $user = User::create($validateData);

        //
        $accessToken = $user->createToken('authToken')->accessToken;

        return response(['user'=>$user,'access_token'=>$accessToken]);

    }

    public function login(Request $request){

        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required',

        ]);


        if (!auth()->attempt($loginData)) {
            return $this->errorResponse('invalid credentials', Response::HTTP_UNAUTHORIZED);
        }

        $accessToken = auth()->user()->createToken('authToken')->accessToken;


        return response(['user' => auth()->user()->load(['country','language','level','mode']), 'access_token' => $accessToken]);

        return $this->successResponse($user, Response::HTTP_CREATED);


    }

    public function logout(Request $request) {
        Auth::logout();
        return $this->successResponse('successfully logged out',Response::HTTP_OK);
    }

}
