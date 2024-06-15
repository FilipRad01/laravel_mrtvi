<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        return view("admin.index");
    }

    public function courses(){
        $courses = Course::get();
        return view("admin.course.index", compact('courses'));
    }
}
