<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{setting('site.description')}}">
    <title>{{setting('site.title')}}</title>
    <!-- Custom Style -->
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/mediaqueries.css')}}">
    <!-- Custom Style -->
</head>
<body>
    <!-- Top Progress Bar -->
    @include('partials.top-progress-bar')
    <!-- Top Progress Bar -->

    <!-- Top Menu -->
    @include('partials.top-menu')
    <!-- Top Menu -->

    <!-- Main Content -->
    @yield('content')
    <!-- Main Content -->

    <!-- Footer -->
    @include('partials.footer')
    <!-- Footer -->
    
    <!-- Typed Js for Typing Text -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.10/typed.js"></script>
    <!-- Typed Js for Typing Text -->

    <!-- Custom Script -->
    <script src="{{asset('assets/js/script.js')}}"></script>
    <!-- Custom Script -->
</body>
</html>