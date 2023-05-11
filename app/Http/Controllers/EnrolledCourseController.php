<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\EnrolledCourse;

class EnrolledCourseController extends Controller
{
    public function enrollCourse(Request $request) {
        $user = Auth::user();

        $enrolledCourse = new EnrolledCourse();
        $enrolledCourse->user_id = $user->id;
        $enrolledCourse->course_id = $request->course_id;
        $enrolledCourse->save();

        return response()->json([
            'message' => 'Successfully Enrolled',
            'user_id' => $user,
            'course_id' => $request->course_id,
        ], 201);
        // return 'Hello world';
    }

    public function getEnrolledCourses(Request $request) {
        
        // $enrolledCourses = EnrolledCourse::with('course:id,course_title,course_description,course_introduction,course_thumbnail')
        //                                     ->whereBelongsTo(Auth::user())
        //                                     ->get();
        // $enrolledCourses = EnrolledCourse::with(['course' => function(Builder $query){
        //     $query->whereNull('deleted_at');
        // }])
        //                                     ->whereBelongsTo(Auth::user())
        //                                     ->get();
        $enrolledCourses = EnrolledCourse::has('course')
                                            ->with('course')
                                            ->whereBelongsTo(Auth::user())
                                            ->get();
        
        return response()->json($enrolledCourses);
    }

}

