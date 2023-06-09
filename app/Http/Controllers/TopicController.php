<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    public function Store(Request $request)
    {
        $topic = new Topic();
        $topic->course_id = $request->input('course_id');
        $topic->topic_title = $request->input('topic_title');
        $topic->topic_video = $request->input('topic_video');
        $topic->save();

        return response()->json([
            'message' => 'Topic created successfully',
            'course_id' => $request->course_id,
            'topic_title' => $request->topic_title,
            'topic_video' => $request->topic_video
        ], 201);
    }
    public function getTopicsByCourseId(Request $request, $course_id)
    {
        $topics = Topic::where('course_id', $course_id)->get();

        return response()->json($topics, 200);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $topics = Topic::search($query);

        return response()->json([
            'data' => $topics,
            'query' => $query,
        ], 200);
    }
    public function AllTopic(){
        // Eloquent method
        $allTopics = Topic::paginate(5);
        $courses = Course::all();
        $users = User::all();
        $topics = Topic::all();
        // $categories = DB::table('categories')->latest()->paginate(5);
        return view('deleteTopic', compact('allTopics', 'users', 'topics', 'courses'));
    }
    public function gotoCreateTopic($course_id){
        $course = Course::findOrFail($course_id);
        $courses = Course::all();
        $users = User::all();
        $topics = Topic::all();
        return view('createTopic', compact('users', 'topics', 'course','courses'));
    }
    public function create(Request $request, $courseId)
    {
        $validatedData = $request->validate([
            'topic_title' => 'required|string|max:255',
            'topic_video' => 'nullable|string|max:255',
        ]);

        $topic = new Topic;
        $topic->topic_title = $validatedData['topic_title'];
        $topic->topic_video = $validatedData['topic_video'];
        $topic->course_id = $courseId;
        $topic->save();

        return redirect()->back()->with('success', 'Topic created successfully!');
    }

}