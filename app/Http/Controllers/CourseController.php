<?php

// app/Http/Controllers/CourseController.php

namespace App\Http\Controllers;

use App\Http\Filters\CourseFilter;
use App\Models\Course;
use App\Models\Lecture;
use App\Models\User;
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
    public function index(CourseFilter $filter)
    {
        $courses = Course::filter($filter)->with(['users' => fn ($query) => $query->where('users.id', Auth::user()->id)])->paginate(4);
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
        $imgName = time().'.'.$extension;
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
            'description' => 'required',
            'diff' => 'required',
            'image' => 'sometimes|nullable|mimes:jpg,png,svg|max:2048',
        ]);

        $img = $course->img;

        if($request->image) {
            $extension = $request->file('image')->extension();
            $imgName = time().'.'.$extension;
            $request->image->storeAs('public/images/courses/'.$request->name, $imgName);
            $img = 'images/courses/'.$request->name.'/'.$imgName;
        }

        $course->update([
            'name' => $request->name,
            'description' => $request->description,
            'diff' => $request->diff,
            'image' => $img
        ]);


        return redirect()->route('courses.index')
                        ->with('success','Course updated successfully');
    }

    public function destroy(Course $course)
    {
        $course->delete();

        if(Auth::user()->role == 'admin') {
            return redirect()->route('admin.courses')
                ->with('success','Course deleted successfully');
        }

        return redirect()->route('courses.index')
                        ->with('success','Course deleted successfully');
    }
    
    public function show(string $id){
        $course = Course::where('id',$id)->with('users','prof')->firstOrFail();
        $completed = false;
        $userInCourse = false;
        foreach($course->users as $user) {
            if($user->id == Auth::user()->id) {
              $userInCourse = true;
              break;
            }
        }
    
        $user = User::where('id', Auth::user()->id)->with(['courses' => fn ($query) => $query->where('courses.id', $course->id)])->get()->first();
        
        if($user->courses->count() != 0) {
            $completed = $user->courses[0]->pivot->completed;
        } 

        $lectures = Lecture::where('course_id', $id)->with('users')->get();

        foreach($lectures as $lecture) {
            foreach($lecture->users as $user) {
                if($user->id === Auth::user()->id) {
                    $lecture->done = true;
                    break;
                }
            }
        }

        return view('courses.show' , [
            'course' => $course,
            "lectures" => $lectures,
            'joined' => $userInCourse,
            'completed' => $completed
        ]);
    }

    

}
