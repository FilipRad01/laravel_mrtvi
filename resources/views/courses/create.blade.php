@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/course_create.css') }}">
@endsection

@section('content')
    <div class="container course-new">
        <div class="card p-4">
            <div class="header">
                <h1 class="title">Add Course</h1>
            </div>
            <div class="info">
                <form action="{{ route('courses.store') }}"  enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Course Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                    <input class="pb-3" type="file" name="image" accept=".jpg,.png,.svg"/>
                    <select class="form-select" name="diff" aria-label="Default select example">
                        <option selected>Choose difficulty</option>
                        <option value="Easy">Easy</option>
                        <option value="Medium">Medium</option>
                        <option value="Hard">Hard</option>
                    </select>
                </div>
                <div class="footer mt-4">
                    <button type="submit" class="btn btn-primary action">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection