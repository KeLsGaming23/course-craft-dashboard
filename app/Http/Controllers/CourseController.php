<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Topic;
use App\Models\User;
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

        $course_thumbnail = $request->file('course_thumbnail');
        if ($course_thumbnail) {
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($course_thumbnail->getClientOriginalExtension());
            $image_name = $name_gen . "." . $img_ext;
            $up_location = 'image/course/';
            $last_img = 'http://127.0.0.1:8000/' . $up_location . $image_name;
            $course_thumbnail->move($up_location, $image_name);
            $course->course_thumbnail = $last_img;
        }
        $course->save();
        return response()->json([
            'message' => 'Course created successfully',
            'user_id' => $user,
            'course_thumbnail' => $last_img ?? null,
            'course_title' => $request->course_title,
            'course_description' => $request->course_description
        ], 201);
    }
    public function GetCourseData(Request $request)
    {
        $course_data = Course::all();
        return response()->json($course_data);
    }
    public function AllCourses(){
        // Eloquent method
        $courses = Course::paginate(5);
        $users = User::all();
        $topics = Topic::all();
        // $categories = DB::table('categories')->latest()->paginate(5);
        return view('deleteCourse', compact('courses', 'users', 'topics'));
    }
    public function deleteCourse($id){
        $course = Course::find($id)->delete();
        return redirect()->back()->with('success', 'Course deleted successfully');
    }
}