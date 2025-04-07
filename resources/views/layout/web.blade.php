<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{setting('site.description')}}">
    <title>{{setting('site.title')}}</title>
    
    <!-- Favicon -->
    <link rel="icon" href="{{asset('public/assets/favicon/favicon.ico')}}">
    <link rel="apple-touch-icon" href="{{asset('public/assets/favicon/apple-touch-icon.png')}}">

    <link rel="icon" href="{{asset('public/assets/favicon/favicon-32x32.png')}}" sizes="32x32" type="image/png">
    <link rel="icon" href="{{asset('public/assets/favicon/favicon-16x16.png')}}" sizes="16x16" type="image/png">
    <link rel="icon" href="{{asset('public/assets/favicon/android-chrome-192x192.png')}}" sizes="192x192" type="image/png">
   
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
   
    <!-- Select 2 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" />
    
    <link rel="canonical" href="{{request()->url()}}" />
    
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <!-- Select 2 -->

    <!-- Custom Style -->
    <link rel="stylesheet" href="{{asset('public/assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('public/assets/css/mediaqueries.css')}}">
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
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    
    <!-- Typed Js for Typing Text -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.10/typed.js"></script>
    <!-- Typed Js for Typing Text -->

    <!-- Select 2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <!-- Select 2 -->

    <!-- Swiper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>


    <!-- Custom Script -->
    <script src="{{asset('public/assets/js/script.js')}}"></script>
    <script src="{{asset('public/assets/js/darkmode.js')}}" defer></script>
    <!-- Custom Script -->

    <script>
        $(document).ready(function(){
            $('.select2').select2();
        });
    </script>
</body>
</html>