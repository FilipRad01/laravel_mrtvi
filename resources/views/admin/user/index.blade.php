@extends('layouts.admin')

@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection



@section('content')

    <h1 class="d-flex justify-content-center align-items-center">Users</h1>

    <form method="GET">
        <input class="search" name="search" type="text" placeholder="Enter name, e-mail..." />
    </form>


    <table class="customers">
        <thead>
            <th>#</th>
            <th>Name</th>
            <th>E-mail</th>
            <th>Current role</th>
            <th>Change role</th>
        </thead>
    
        <tbody>   
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                    @if($user->id !== Auth::user()->id)
                    <td>
                        <select class="roles-select" name="role" data-target="{{ $user->id }}">
                            <option value="0">Select role...</option>
                            <option value="user">User</option>
                            <option value="prof">Professor</option>
                            <option value="admin">Admin</option>
                        </select>
                    </td>
                    @endif
                </tr>
            @endforeach
        </tbody>

    </table>

    {{ $users->withQueryString()->links() }}


<script>
    document.addEventListener("DOMContentLoaded", function() {
    // Select all <select> elements with the name "role"
    var selectElements = document.querySelectorAll('select[name="role"]');

    // Iterate over each <select> element
    selectElements.forEach(function(selectElement) {
        // Add an event listener for the 'change' event
        selectElement.addEventListener('change', function(event) {
            // Log the data-target attribute value to the console
            const id = this.getAttribute('data-target');
            const role = this.value;
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');


            const url = `/users/${id}/role`;
            const data = { role };

            fetch(url, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    "X-CSRF-Token": csrfToken,
                },
                body: JSON.stringify(data),
            })
        .then(response => response.json())
        .then(data => {
            window.location.reload();
            })
        });
    });
});
</script>

@endsection