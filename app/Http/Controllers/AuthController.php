<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function Login(Request $request){
        try{
            if(Auth::attempt($request->only('email', 'password'))){
                $user = Auth::user();
                // $token = Str::random(60);
                $token = $user->createToken('app')->accessToken;

                return response([
                    'message' => 'Successfully Login',
                    'token' => $token,
                    'user' => $user
                ], 200)->header('Authorization', 'Bearer ' . $token); // Add this line to include the Bearer token in the response header
            }
        }catch(Exception $exception){
            return response([
                'message' => $exception->getMessage()
            ],400);
        }
        return response([
            'message' => 'Invalide email or password'
        ], 401);
    }

    public function Register(RegisterRequest $request){
        try{

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            $token = $user->createToken('app')->accessToken;
            // $token = Str::random(60);
            return response([
                'message' => 'Register Successfully',
                'token' => $token,
                'user' => $user
            ],200);
        }catch(Exception $exception){
            return response([
                'message' => $exception->getMessage()
            ],400);
        }
    }
}
