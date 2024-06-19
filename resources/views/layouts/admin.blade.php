<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    @yield('head')
    <!-- Bootstrap CSS -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
    <style>
       .sidebar {
            height: calc(100vh - 56px); /* Adjust based on navbar height */
            overflow-y: auto;
        }
       .content {
            padding: 20px;
        }
    </style>
    @yield('styles')
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse h3  fw-bold">
            
            <div class="list-group list-group-flush">
                <a href="{{ route('courses.index') }}" class="list-group-item list-group-item-action">To home</a>

                <a href="{{route('admin.courses')}}" class="list-group-item list-group-item-action">Courses</a>           
                <a href="{{ route('admin.users') }}" class="list-group-item list-group-item-action">Users</a>
            </div>
        </nav>

        <!-- Content -->
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Admin Panel</h1>
            </div>
            <div class="content">
                @yield('content')
            </div>
        </main>
    </div>
</div>

</body>
</html>