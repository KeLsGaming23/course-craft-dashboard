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

    public function UpdateUser(Request $request, $id)
    {
        $update = User::find($id)->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        return response()->json($update);
    }
    public function storeImage(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'image' => 'required|image|max:2048', // Maximum image size of 2MB
        ]);

        // Get the user ID
        $user_id = Auth::id();

        // Get the uploaded image
        $image = $request->file('image');
        $up_location = 'image/profile-image/';
        // Generate a unique filename for the image
        $filename = "http://localhost:8000/" . $up_location . 'user-' . $user_id . '-' . time() . '.' . $image->getClientOriginalExtension();
        // Store the image in the public/images/profile-image directory
        $path = $image->move('image/profile-image', $filename);

        // Update the user's image column in the database
        $user = User::findOrFail($user_id);
        $user->users_img = $filename;
        $user->save();

        // Return a response
        return response()->json([
            'message' => 'Image uploaded successfully',
            'path' => $filename
        ], 200);
    }
}