@extends('layouts.app')

@section('styles')
    @vite(['resources/css/course_edit.css'])
@endsection

@section('content')
<h1>Edit Course</h1>
<a href="{{ route('courses.index') }}" class="btn btn-primary me-2">Back to Courses</a>
<div class="container">
    <form action="{{ route('courses.update', $course->id) }}" method="POST" enctype="multipart/form-data">
        @method('PATCH')
            @csrf
            <div class="form-group">
                <label for="name">Course Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $course->name) }}" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $course->description) }}</textarea>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control" id="image" name="image" />
            </div>
            <div class="form-group">
                <label for="diff">Difficulty was {{ $course->diff }}</label>
                <select class="form-select" name="diff" value="{{ $course->diff }}" aria-label="Default select example">
                    <option value="{{ old('diff', $course->diff) }}">Choose new difficulty</option>
                    <option value="Easy">Easy</option>
                    <option value="Medium">Medium</option>
                    <option value="Hard">Hard</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update Course</button>
        </form>
    </div>
@endsection
