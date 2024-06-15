@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/lecture_show.css') }}">
@endsection

@section('content')
    <div class="lecture-container">
        <h1>{{ $lecture->name }}</h1>
        <a href="{{ route('courses.show',['course' => $lecture->course_id]) }}" class="btn btn-primary me-2">Back to Lectures</a>
        <div class="pt-4">
            <div class="row row-cols-1 row-cols-lg-2 g-4">
                <div class="col">
                    <div class="card h-100 custom-card">
                        <div class="card-content-wrapper">
                            <div class="card-content">
                                <h5 class="card-title">{{ $lecture->name }}</h5>
                                <p class="card-text">{{ $lecture->description }}</p>
                                @if(Auth::user()->role == 'admin' || $lecture->course->professor==Auth::user()->id)
                                    <div class="button-group d-flex justify-content-between px-2">
                                        <a href="{{ route('lectures.edit',['course'=>$lecture->course_id, 'lecture'=>$lecture->id]) }}" class="btn btn-primary me-2"><x-lucide-pencil/></a>
                                        <form action="{{ route('lectures.destroy', ['course'=>$lecture->course_id, 'lecture'=>$lecture->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"><x-lucide-trash-2/></button>
                                        </form>
                                    </div>
                                @endif
                                @if(!$lecture->done)
                                    <form method="POST" class="d-flex justify-content-center py-2" action="{{ route('lectures.check', ['course' => $lecture->course_id, 'lecture' => $lecture->id]) }}">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Check</button>
                                    </form>
                                @else 
                                    <h1>DONE</h1>
                                @endif
                            </div>
                        </div>
                        <div class="card-footer text-white bg-primary">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

