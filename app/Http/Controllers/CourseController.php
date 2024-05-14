<?php

// app/Http/Controllers/CourseController.php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lecture;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware(['role:prof'], only: ['create','store']),
            new Middleware(['owner:course'], only: ['update','destroy','edit']),
        ];
    }
    public function index()
    {
        $courses = Course::paginate(6);
        return view('courses.index', ["courses"=>$courses]);
    }

    public function create()
    {
        return view('courses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'nullable',
            'diff'=> 'required',
            'image' => 'required|mimes:jpg,png,svg|max:1024',
        ]);

        $extension = $request->file('image')->extension();
        $imgName = time().$extension;
        Course::create([
            'professor'=>Auth::user()->id,
            'name'=> $request->name,
            'description'=> $request->description,
            'diff' => $request->diff,
            'image' => 'images/courses/'.$request->name.'/'.$imgName,
        ]);
        $request->image->storeAs('public/images/courses/'.$request->name, $imgName);
        return redirect()->route('courses.index')
                        ->with('success','Course created successfully.');
    }

    public function edit(Course $course)
    {
        return view('courses.edit',compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'diff' => 'required',
        ]);

        $course->update($request->all());
        return redirect()->route('courses.index')
                        ->with('success','Course updated successfully');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('courses.index')
                        ->with('success','Course deleted successfully');
    }
    
    public function show(string $id){
        $course = Course::where('id',$id)->with('users','prof')->firstOrFail();
        $userInCourse = false;
        foreach($course->users as $user) {
            if($user->id == Auth::user()->id) {
              $userInCourse = true;
              break;
            }
          }
        $lectures = Lecture::where('course_id', $id)->get();
        return view('courses.show' , [
            'course' => $course,
            "lectures" => $lectures,
            'joined' => $userInCourse
        ]);
    }
    

}
