<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\UserController;
use App\Models\Course;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::post('/customLogout', function () {
    Auth::logout();
    return redirect('http://localhost:3000/ErrorPage');
})->name('customLogout');
Route::post('/customLogin', function (Request $request) {
    $credentials = $request->only('email', 'password');
    if (Auth::attempt($credentials)) {
        return redirect()->intended('/dashboard');
    }
    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ]);
})->name('customLogin');
Route::get('/dashboard', function () {
    $users = User::all();
    $courses = Course::all();
    $topics = Topic::all();
    return view('dashboard', compact('users', 'courses', 'topics'));
})->middleware(['auth', 'verified', 'role:0'])->name('dashboard');
Route::get('deleteCourse', [CourseController::class, 'AllCourses'])
    ->middleware(['auth', 'verified', 'role:0'])
    ->name('deleteCourse');
Route::get('deletingCourse/{id}', [CourseController::class, 'deleteCourse'])
    ->middleware(['auth', 'verified', 'role:0']);

Route::get('deleteTopic', [TopicController::class, 'AllTopic'])
    ->middleware(['auth', 'verified', 'role:0'])
    ->name('deleteTopic');
Route::get('deletingTopic/{id}', [TopicController::class, 'deleteTopic'])
    ->middleware(['auth', 'verified', 'role:0']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::put('/users/{user}', [UserController::class, 'updateRole'])->name('makeAdmin');
Route::put('/instructor/{user}', [UserController::class, 'makeItInstructor'])->name('users.update.instructor');

require __DIR__.'/auth.php';
