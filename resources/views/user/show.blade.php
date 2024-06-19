@extends('layouts.app')


@section('styles')
    <link rel="stylesheet" href="{{ asset('css/course.css') }}">
@endsection


@section('content')

    <body class="bg-zinc-100 font-sans leading-normal tracking-normal">
        <div class="container mx-auto p-8 mt-5">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white rounded-lg p-4 card my-4">
                    <div class="flex flex-col items-center pb-10">
                        <h3 class="mb-1 text-xl font-medium text-zinc-900 m-0"><b>Name:</b> {{ $user->name }}</h3>
                        <div class="">
                            <h3 class="text-sm text-zinc-600"><b>Email:</b> {{ $user->email }}</h3>
                        </div>
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">Edit</a>
                    </div>
                </div>

                <h2 class="text-xl font-bold mb-2">Joined courses</h2>
                <div class="row">
                    <div class="container">
                        <div class="row row-cols-1 row-cols-lg-2 g-4">
                            @foreach ($user->courses as $course)
                                <x-course-card :course="$course" />
                            @endforeach
                        </div>
                    </div>
            </div>
        </div>
    </body>
@endsection
