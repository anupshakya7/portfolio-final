<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{setting('site.description')}}">
    <title>@yield('code') | @yield('message')</title>
    
    <!-- Favicon -->
    <link rel="icon" href="{{set_url('assets/favicon/favicon.ico')}}">
    <link rel="apple-touch-icon" href="{{set_url('assets/favicon/apple-touch-icon.png')}}">

    <link rel="icon" href="{{set_url('assets/favicon/favicon-32x32.png')}}" sizes="32x32" type="image/png">
    <link rel="icon" href="{{set_url('assets/favicon/favicon-16x16.png')}}" sizes="16x16" type="image/png">
    <link rel="icon" href="{{set_url('assets/favicon/android-chrome-192x192.png')}}" sizes="192x192" type="image/png">
   
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />

    <!-- Custom Style -->
    <link rel="stylesheet" href="{{set_url('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{set_url('assets/css/error.css')}}">
    <link rel="stylesheet" href="{{set_url('assets/css/mediaqueries.css')}}">
    <!-- Custom Style -->
</head>
<body>

    <!-- Main Content -->
    <div class="error_page">
        <h2>@yield('code')</h2>
        <p>@yield('message')</p>
        <button class="btn btn-color-1" onclick="location.href='/'">Back Home</button>
    </div>
    <!-- Main Content -->

</body>
</html>