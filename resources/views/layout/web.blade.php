<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{setting('site.description')}}">
    <title>{{setting('site.title')}}</title>
   
    <!-- Select 2 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" />
    <!-- Select 2 -->

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

    <!-- Select 2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <!-- Select 2 -->

    <!-- Custom Script -->
    <script src="{{asset('assets/js/script.js')}}"></script>
    <!-- Custom Script -->

    <script>
        $(document).read(function(){
            $('.select2').select2();
        });
    </script>
</body>
</html>