<!-- resources/views/layouts/app.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Default Title')</title>
    @vite(['resources/sass/app.scss', 'resources/css/app.css', 'resources/js/app.js' ])
    @yield('styles')
    <link rel="icon" href="{{ asset('storage/images/courses/default.jpg') }}">
</head>
<body>
    <x-navbar/>
    <div class="w-100">
        <div class="w-100 main">
            @yield('content')
        </div>
        <x-sidebar/>
    </div>
    @yield('scripts')
</body>
</html>
