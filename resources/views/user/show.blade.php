@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>User Details</h2>
            <p>Name: {{ $user->name }}</p>
            <p>Email: {{ $user->email }}</p>
            <p>Joined Courses:</p>
            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">Edit</a>
        </div>
    </div>
</div>
@endsection