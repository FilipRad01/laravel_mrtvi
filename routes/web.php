<?php
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LectureController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;



Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    });
    
    
    Route::get('/register', function () {
        return view('auth.register');
    });
    
    Route::post('/login',[LoginController::class,"login"])->name('login');
    Route::post('/register',[RegisterController::class,"register"])->name('register');
});

Route::middleware('auth')->group(function () { 
    Route::get('/', function () {
        return redirect(route('courses.index'));
    });
    // Route::get('/courses/{course}/edit', [CourseController::class, 'edit'])->name('courses.edit');
    // Route::put('/courses/{course}', [CourseController::class, 'update'])->name('courses.update');
    Route::resource('/courses', CourseController::class);
    Route::resource('/courses/{course}/lectures', LectureController::class)->middleware('auth');
    Route::delete('courses/{course}/lectures/{lecture}', [LectureController::class, 'destroy'])->name('lectures.destroy');
    Route::post('/courses/{course}/join', [UserController::class,'joinCourse'])->name('courses.join');
    Route::resource('/users',UserController::class);
    Route::post('/logout',[LoginController::class,'logout'])->name('logout');
    });

