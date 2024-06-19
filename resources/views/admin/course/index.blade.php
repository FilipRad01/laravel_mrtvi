@extends('layouts.admin')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')

<h1 class="d-flex justify-content-center align-items-center">Courses</h1>

<form method="GET">
    <input class="search" name="search" type="text" placeholder="Unesite naziv kursa..." />
</form>

<table class="customers">
    <thead>
        <th>#</th>
        <th>Name</th>
        <th>Professor</th>
        <th>Difficulty</th>
        <th>Actions</th>
    </thead>

    <tbody>   
        @foreach ($courses as $course)
            <tr>
                <td>{{ $course->id }}</td>
                <td>{{ $course->name }}</td>
                <td>{{ $course->prof->name }}</td>
                <td>{{ $course->diff }}</td>
                <td>
                    <div class="d-flex gap-5">
                        <a href="{{ route('courses.edit', $course->id) }}" class="">
                            <x-lucide-pencil/>
                        </a>
                        <form method="POST" class="" action="{{ route('courses.destroy', $course->id) }}">
                            @method('delete')
                            @csrf
                            <button type="submit">
                                <x-lucide-trash-2 />
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

{{ $courses->withQueryString()->links() }}
@endsection