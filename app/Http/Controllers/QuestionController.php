<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Models\StudentQuestion;
use Illuminate\Support\Facades\Auth;


class QuestionController extends Controller
{
    public function studentQuestion(Request $request, $course_id) {
        $user = Auth::user();

        $question = new StudentQuestion();
        $question->user_id = $user->id;
        $question->course_id = $course_id;
        $question->question = $request->question;
        $question->save();
        return response()->json([
            'message' => 'Successfully Ask Question',
            'user_id' => $user,
            'course_id' => $request->course_id,
            'question' => $request->question
        ], 201);
    }
        
    public function getStudentQuestion(Request $request, $course_id) {
        $user = Auth::user();
    
        $studentQuestions = StudentQuestion::where('course_id', $course_id)
            ->where('user_id', $user->id)
            ->get();
    
        return response()->json($studentQuestions);
    }
    
}
