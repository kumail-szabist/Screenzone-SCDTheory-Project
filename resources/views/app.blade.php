<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ScreenZone</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>
<body>
    @include('header')
    <div class="container mt-4">
        @yield('content')
    </div>
    @include('footer')
</body>
</html>
