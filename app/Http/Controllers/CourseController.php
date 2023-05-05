<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function CreateCourse(Request $request)
    {
        $user = Auth::user();

        $course = new Course();
        $course->user_id = $user->id;
        $course->course_title = $request->input('course_title');
        $course->course_description = $request->input('course_description');
        $course->course_thumbnail = $request->input('course_thumbnail');
        $course->course_introduction = $request->input('course_introduction');
        $course->save();

        return response()->json([
            'message' => 'Course created successfully',
            'user_id' => $user,
            'course_title' => $request->course_title,
            'course_description' => $request->course_description
        ], 201);
    }
    public function GetCourseData(Request $request){
        $course_data = Course::all();
        $jsonData = $course_data->toJson();
        return response()->json($jsonData);
    }
}
