<?php

namespace App\Http\Controllers;

use App\Models\Lecture;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

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
    public function show(string $course, string $id)
    {
        $lecture = Lecture::findOrFail($id)->with('course')->get()->first();
        return view('lectures.show' , [
            'lecture'=> $lecture,
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
}
