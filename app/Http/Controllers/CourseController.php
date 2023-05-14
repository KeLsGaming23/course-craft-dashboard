<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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
        $topics = Topic::where('course_id', $id)->delete();
        $course = Course::find($id)->delete();
        return redirect()->back()->with('success', 'Course deleted successfully');
    }
    public function goToCreateCourse(){
        $courses = Course::all();
        $users = User::all();
        $topics = Topic::all();
        return view('createCourse', compact('courses', 'users', 'topics'));
    }
    public function storeNewCourse(Request $request)
    {
        $validated = $request->validate([
            'course_title' => 'required|unique:courses|min:4',
            'course_description' => 'required|unique:courses|min:4',
            'course_thumbnail' => 'required|mimes:jpg,jpeg,png',
            'course_introduction' => 'required',
        ],
        [
            'course_title.required' => 'Please enter Course Title',
        ]);
        
        $course_image = $request->file('course_thumbnail');
        $image_gen = hexdec(uniqid());
        $img_ext = strtolower($course_image->getClientOriginalExtension());
        $image_name = $image_gen . "." . $img_ext;
        $up_location = 'image/course/';
        $last_img = "http://localhost:8000/" . $up_location . $image_name;
        $course_image->move($up_location, $image_name);

        // Parse Youtube Video
        // $course_link = 'https://www.youtube.com/embed/';
        // $youtube_link = $request->youtube_link;
        // $video_id = str_replace('https://www.youtube.com/watch?v=', '', $youtube_link);
        // $youtube_parse_link = $course_link . $video_id;
        $user_id = auth()->id();
        Course::create([
            'user_id' => $user_id,
            'course_title' => $request->course_title,
            'course_thumbnail' => $last_img,
            'course_description' => $request->course_description,
            'course_introduction' => $request->course_introduction,
            'created_at' => Carbon::now()
        ]);
        
        return redirect()->back()->with('success', 'New Course Created');
    }

}