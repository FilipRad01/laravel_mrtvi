@extends('layouts.app')
@section('title',"$course->name")
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/course_show.css') }}">
@endsection


@section('content')
    <h1>{{ $course->name }}</h1>
    <a href="{{ route('courses.index') }}" class="btn btn-primary me-2"><x-lucide-circle-arrow-left/></a>
    <div class="container">
        <div class="card">
            <div class="card-header">
                Course Details
            </div>
            <div class="card-body">
                <h5 class="card-title">{{ $course->name }}</h5>
                <p class="card-text">{{ $course->description }}</p>
                <p class="card-text">Difficulty: {{ $course->diff }}</p>
                @if($joined)
                <button type="submit" class="btn btn-info">Joined</button>
                @else
                <form method="POST" action="{{ route('courses.join', $course->id) }}">
                    @csrf
                    <button type="submit" class="btn btn-danger">Joint</button>
                </form>
                @endif
                @if(Auth::user()->role == 'admin')
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
    </div>
        @if(Auth::user()->role == 'admin')
            <a href="{{ route('lectures.create',['course' => $course->id]) }}" class="btn btn-primary me-2">Add Lecture</a>
        @endif
        <x-lecture :lectures="$lectures" :joined="$joined" />
    </div>
@endsection