@extends('layouts.app')

@section('content')

    <body class="bg-zinc-100 font-sans leading-normal tracking-normal">
        <div class="container mx-auto p-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white rounded-lg p-4 shadow-lg">
                    <div class="flex flex-col items-center pb-10">
                        <img class="mb-3 w-24 h-24 rounded-full shadow-lg" src="https://placehold.co/100x100"
                            alt="profile image" />
                        <h3 class="mb-1 text-xl font-medium text-zinc-900">{{ $user->name }}</h3>
                        <div class="mt-4">
                            <p class="text-sm text-zinc-600">{{ $user->email }}</p>
                        </div>
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">Edit</a>
                    </div>
                </div>

                <h2 class="text-xl font-bold mb-2">Joined courses</h2>
                @foreach ($user->courses as $course)
                    <div class="container mx-auto p-8 ">
                        <div class="grid gap-4">
                            <div class="bg-white dark:bg-zinc-700 rounded-lg p-4 g-col-4">
                                <div class="flex items-center pb-10 shadow-lg w-25 ">
                                    <img class="mb-3 w-24 h-24 rounded-full shadow-lg" src="https://placehold.co/100x100"
                                        alt="profile image" />
                                    <h3 class="mb-1 text-xl font-medium text-zinc-900 dark:text-zinc-100">
                                        {{ $course->name }}</h3>
                                    <span class="text-sm text-zinc-500 dark:text-zinc-400">Professor:
                                        {{ $course->prof->name }}</span>
                                    <div class="mt-4">
                                        <p class="text-sm text-zinc-600 dark:text-zinc-300">Diff:</p>
                                    </div>
                                    <button class="mt-4 bg-blue-500 dark:bg-blue-700 text-white p-2 rounded-lg">
                                        Enter
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </body>
@endsection
