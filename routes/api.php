<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ForgetController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EnrolledCourseController;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
//Login Route
Route::post('/login', [AuthController::class, 'Login']);
//Register Route
Route::post('/register', [AuthController::class, 'Register']);
//Forget Pasword Route
Route::post('/forget/password', [ForgetController::class, 'ForgetPassword']);
//Reset Pasword Route
Route::post('/reset/password', [ResetController::class, 'ResetPassword']);
//Current User Route
Route::get('/user', [UserController::class, 'User'])->middleware('auth:api');
//Update Current User
Route::post('/user/{id}', [UserController::class, 'UpdateUser'])->middleware('auth:api');
//Create New Course Route
Route::post('/create/course', [CourseController::class, 'CreateCourse'])->middleware('auth:api');
//Get Course Route
Route::get('/get/course', [CourseController::class, 'GetCourseData']);
//Create Topic Route
Route::post('/create/topic', [TopicController::class, 'Store']);
//Create Topic Route
Route::get('topics/course/{course_id}', [TopicController::class, 'getTopicsByCourseId']);
//SearhREsult Topic Route
Route::get('/search', [TopicController::class, 'search'])->name('topic.search');

// Student Enrolled Course Route
Route::post('/enrollCourse/{course_id}', [EnrolledCourseController::class, 'enrollCourse'])->middleware('auth:api');

Route::get('/enrolledCourses', [EnrolledCourseController::class, 'getEnrolledCourses'])->middleware('auth:api');