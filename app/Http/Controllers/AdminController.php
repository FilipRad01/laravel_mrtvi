<?php

namespace App\Http\Controllers;

use App\Http\Filters\CourseFilter;
use App\Http\Filters\UserFilter;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        return view("admin.index");
    }

    public function courses(CourseFilter $filter){
        $courses = Course::filter($filter)->with('prof')->paginate(15);
        return view("admin.course.index", compact('courses'));
    }

    public function users(UserFilter $filter) {
        $users = User::filter($filter)->paginate(15);

        return view("admin.user.index", compact('users'));
    }
}
