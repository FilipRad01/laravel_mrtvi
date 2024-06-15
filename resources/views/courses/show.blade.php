@extends('layouts.app')
@section('title',"$course->name")
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/course_show.css') }}">
@endsection

@section('content')
    <div class="course-container">
        <div class="d-flex align-items-center justify-content-between ">
            <a href="{{ route('courses.index') }}" class="btn btn-primary me-2  "><x-lucide-circle-arrow-left/></a>
            <h1>{{ $course->name }}</h1>
            @if($completed)
                
            @endif
            <div class="">

            </div>
        </div>
        <div class="">
            <div class="card">
                <div class="card-header">
                    Course Details  
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $course->name }}</h5>
                    <p class="card-text">{{ $course->description }}</p>
                    <p class="card-text">Difficulty: {{ $course->diff }}</p>
                    @if(Auth::user()->role != 'prof')
                        @if($joined)
                        <button type="submit" class="btn btn-info">Joined</button>
                        @else
                        <form method="POST" action="{{ route('courses.join', $course->id) }}">
                            @csrf
                            <button type="submit" class="btn btn-danger">Join</button>
                        </form>
                        @endif
                    @endif
                    @if(Auth::user()->role == 'admin' || $course->professor==Auth::user()->id)
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-primary me-2"><x-lucide-pencil/></a>
                        <form action="{{ route('courses.destroy', $course->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"><x-lucide-trash-2/></button>
                        </form>
                    </div>
                    @endif
                </div>
                <div class="card-footer">
                    Created at: {{ $course->created_at }}
                </div>
            </div>
        </div>
        <div class="mt-5 d-flex flex-column align-items-center">
            @if($course->professor==Auth::user()->id || Auth::user()->role == 'admin')
                <a href="{{ route('lectures.create',['course' => $course->id]) }}" class="btn btn-primary me-2">Add Lecture</a>
            @endif
            <x-lecture :lectures="$lectures" :joined="$joined" :prof="$course->professor" />
        </div>
    </div>
    
@endsection
