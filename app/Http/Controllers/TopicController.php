<?php

namespace App\Http\Controllers;

use App\Models\Topic;
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
}