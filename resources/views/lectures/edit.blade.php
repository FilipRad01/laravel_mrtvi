@extends('layouts.app')



@section('content')
<h1>Edit Course</h1>
<a href="{{ route('courses.show',['course' => $lecture->course_id]) }}" class="btn btn-primary me-2">Back to Lectures</a>
<div class="container">
    <form action="{{ route('lectures.update', ['course'=>$lecture->course_id, 'lecture'=>$lecture->id]) }}" method="POST">
        @method('PATCH')
            @csrf
            <div class="form-group">
                <label for="name">Lecture Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $lecture->name) }}" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $lecture->description) }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update Lecture</button>
        </form>
    </div>
@endsection
