<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResetRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ResetController extends Controller
{
    public function ResetPassword(ResetRequest $request){
        $email = $request->email;
        $token = $request->token;
        $password = Hash::make($request->password);
        
        $mailChecked = DB::table('password_reset_tokens')->where('email', $email)->first();
        $pinChecked = DB::table('password_reset_tokens')->where('token', $token)->first();

        if(!$mailChecked){
            return response([
                'message' => 'Email not found'
            ]);
        }

        if(!$pinChecked){
            return response([
                'message' => 'Pin code Invalid'
            ]);
        }
        DB::table('users')->where('email', $email)->update(['password' => $password]);
        DB::table('password_reset_tokens')->where('email', $email)->delete();
        return response([
            'message' => 'Password change successfully'
        ],200);
    }
}
