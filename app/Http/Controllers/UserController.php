<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function User(Request $request){
        return Auth::user();
    }
    public function makeAdmin(User $user)
    {
        $user->update(['role' => 1]);
        return redirect()->back()->with('success', 'User role has been updated to admin.');
    }
    public function updateRole(User $user)
    {
        $user->role = 0; // Or any other value that represents an admin user
        $user->save();
        
        return redirect()->back()->with('success', 'User role updated successfully.');
    }
    public function makeItInstructor(User $user)
    {
        $user->role = 2; // Or any other value that represents an admin user
        $user->save();
        
        return redirect()->back()->with('success', 'User role updated successfully.');
    }
}