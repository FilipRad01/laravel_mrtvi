<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lecture;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;

class LectureController extends Controller implements HasMiddleware
{
    public static function middleware(): array {
        return [
            new Middleware(['owner:course'], only: ['create', 'edit', 'update', 'store', 'destroy'])
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('lectures.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $course)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'nullable',
        ]);

        Lecture::create([
            'name'=> $request->name,
            'description'=> $request->description,
            'course_id' => $course
        ]);
        return redirect()->route('courses.show', $course)
                        ->with('success','Lecture created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $course, string $lecture)
    {
        $lect = Lecture::with('course', 'users')->where('id', $lecture)->get()->first();

        foreach($lect->users as $user) {
            if($user->id === Auth::user()->id) {
                $lect['done'] = true;
                break;
            }
        }

        return view('lectures.show' , [
            'lecture'=> $lect,
        ]);
        // proveri da li je korisnik koji pristupa ovome admin ili onaj koji je vec na kursu
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id,string $lecture)
    {
        $lecture = Lecture::findOrFail($lecture);
        
        return view('lectures.edit', compact('lecture'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id, string $lecture)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
        ]);
        $lecture=Lecture::find($lecture);
        $lecture->update([
            'name'=> $request->name,
            'description'=> $request->description,
        ]);
        return redirect(route('courses.show', $lecture->course_id))->with('success', 'Lecture successfully updeted');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $course, string $lecture)
    {
        
        Lecture::destroy($lecture);
        return redirect(route('courses.show', $course))->with('success', 'Lecture successfully deleted');
    }

    public function check(string $course, string $lecture)
    {
        $cour = Course::where('id', $course)->with([
            'users' => fn ($query) => $query->where('users.id', '=', Auth::user()->id),
        ])->get()->first();

        if(!$cour) abort(403);

        $lect = Lecture::where([
            'course_id' => $course,
            'id' => $lecture
        ]);

        if(!$lect->exists()) abort(403);
        
        $lectureCount = $cour->lectures()->count();

        $alreadyCompleted = User::find(Auth::user()->id)->withCount([
            'lectures' => fn ($query) => $query->where('course_id', '=', $cour->id), 
        ])->get()->first();

        $user = User::find(Auth::user()->id);
        $user->lectures()->syncWithoutDetaching([
            $lecture => [
            'completed' => true, 
        ]]);

        if($alreadyCompleted->lectures_count + 1 == $lectureCount) {
            $user->courses()->syncWithoutDetaching([
                $cour->id => [
                    'completed' => true
                ]
            ]);
        }

        return redirect()->route('courses.show', $cour->id);
        
    }
}
