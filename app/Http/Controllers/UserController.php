<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function User(Request $request){
        return Auth::user();
        // if (($user = Auth::user()) !== null) {
        //     // Here you have your authenticated user model
        //     return response()->json($user);
        // }

        // if (Auth::guard('api')->check()) {
        //     // Here you have access to $request->user() method that
        //     // contains the model of the currently authenticated user.
        //     //
        //     // Note that this method should only work if you call it
        //     // after an Auth::check(), because the user is set in the
        //     // request object by the auth component after a successful
        //     // authentication check/retrival
        //     return response()->json($request->user());
        // }
    
        // return general data
        // return response('Unauthenticated user');
    
    
    }
}
