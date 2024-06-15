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
<div class="container">
    <div class="row row-cols-1 row-cols-lg-2 g-4">
        @foreach ($courses as $course)
            <div class="col">
                <div class="card h-100 custom-card">
                    @if(Auth::user()->role == 'admin' || $course->professor==Auth::user()->id)
                        <div class="admin-buttons">
                            <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-primary me-2" aria-label="Edit"><x-lucide-pencil/></a>
                            <form action="{{ route('courses.destroy', $course->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" aria-label="Delete" class="btn btn-danger"><x-lucide-trash-2/></button>
                            </form>
                        </div>
                    @endif
                    <div class="card-content-wrapper">
                        <div class="card-content">
                            <h5 class="card-title">{{ $course->name }}</h5>
                            <p class="card-text">{{ substr($course->description,0,100) }}</p>
                            <p class="card-text">Difficulty: {{ $course->diff }}</p>
                            <p class="card-text">Created: {{ $course->prof->name }}</p>

                            <div class="button-group">
                                <a href="{{ route('courses.show', $course->id) }}" class="btn btn-primary">See details</a>
                                @if(count($course->users) != 0)
                                    {{-- U kursu je... --}}
                                    @if($course->users[0]->pivot->completed) 
                                        <div class="progress_button completed">
                                            Completed <x-lucide-circle-check-big />
                                        </div>
                                    @else
                                        <div class="progress_button joined">
                                            Joined <x-lucide-circle />
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </div>
                        <a href="{{ route('courses.show', $course->id) }}"  class="card-image" style="background-image: url('{{ asset('storage/'.$course->image) }}');"></a>
                    </div>
                    <div class="card-footer text-white">
                        {{ date_format(date_create($course->created_at),'d.m.Y. H:i')}}, {{ \Carbon\Carbon::parse($course->created_at)->diffForHumans() }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
{{ $courses->withQueryString()->links() }}




@endsection
