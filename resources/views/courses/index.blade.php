@extends('layouts.app')
@section('title','Home')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/course.css') }}">
@endsection

@section('content')
<div class="flex justify-center items-center min-h-screen p-5">
    <div class="text-center">
        <h1 class="fw-bold">Courses</h1>
        @if(Auth::user()->role == 'admin' || Auth::user()->role == 'prof')
            <a href="{{ route('courses.create') }}" class="btn btn-primary me-2">Add Course</a>
        @endif
    </div>
</div>
<div class="container w-100">
    <div class="row row-cols-1 row-cols-lg-2 g-4">
        @foreach ($courses as $course)
            <x-course-card :course="$course" />

        @endforeach
    </div>
</div>
{{ $courses->withQueryString()->links() }}




@endsection
