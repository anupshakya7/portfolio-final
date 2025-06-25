<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Seo Title and Meta Description -->
    @php
        $meta_title='';
        $meta_desc='';
        $meta_image='';
        $meta_image_alt='';
        
        //Meta Title
        if(isset($single) && !empty($single->meta_title)){
            $meta_title = $single->meta_title;
        }elseif(isset(app()->view->getSections()['title']) && app()->view->getSections()['title'] !== null){
            $meta_title = app()->view->getSections()['title'];
        }else{
            $meta_title = setting('site.title');
        }

        //Meta Description
        if(isset($single) && !empty($single->meta_description)){
            $meta_desc = $single->meta_description;
        }elseif(isset(app()->view->getSections()['description']) && app()->view->getSections()['description'] !== null){
            $meta_desc = app()->view->getSections()['description'];
        }else{
            $meta_desc = setting('site.description');
        }

        //Meta Image
        $meta_image = isset($single) && !empty($single->thumbnail) ? set_storage_url($single->thumbnail) : set_storage_url(setting('site.owner_pic'));
        $meta_image_alt = isset($single) && !empty($single->title) ? $single->title : 'Profile Pic'; 
    @endphp

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{$meta_desc}}">
    <title>{{$meta_title}}</title>
    
    <meta property="og:site_name" content="Anup Shakya">
    <meta property="og:title" content="{{$meta_title}}">
    <meta property="og:description" content="{{$meta_desc}}">
    <meta property="og:url" content="https://anup-shakya.com.np/">
    <meta property="og:url" content="website">
    <meta property="og:image" content="{{$meta_image}}">
    <meta property="og:image:width" content="630">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="{{ $meta_image_alt }}">
    
    <!-- Favicon -->
    <link rel="icon" href="{{set_url('assets/favicon/favicon.ico')}}">
    <link rel="apple-touch-icon" href="{{set_url('assets/favicon/apple-touch-icon.png')}}">

    <link rel="icon" href="{{set_url('assets/favicon/favicon-32x32.png')}}" sizes="32x32" type="image/png">
    <link rel="icon" href="{{set_url('assets/favicon/favicon-16x16.png')}}" sizes="16x16" type="image/png">
    <link rel="icon" href="{{set_url('assets/favicon/android-chrome-192x192.png')}}" sizes="192x192" type="image/png">
   
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
   
    <!-- Select 2 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" />
    
    <link rel="canonical" href="{{request()->url()}}" />
    
    <!-- Swiper CSS --> 
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">

    <!-- AOS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Custom Style -->
    <link rel="stylesheet" href="{{set_url('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{set_url('assets/css/mediaqueries.css')}}">
    <!-- Custom Style -->
    
    <!--Schema Markup-->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org/",
      "@type": "Person",
      "name": "Anup Shakya",
      "url": "https://anup-shakya.com.np",
      "jobTitle":"Full Stack Developer",
      "sameAs":[
            "https://www.linkedin.com/in/anup-shakya7/",
            "https://github.com/anupshakya7"
        ]
    }
    </script>
    <!--Schema Markup-->
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
    
    <!--Equal Height-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.matchHeight/0.7.2/jquery.matchHeight-min.js"></script>
    <!--Equal Height-->

    <!-- Swiper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <!-- AOS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>


    <!-- Custom Script -->
    <script src="{{config('app.url').'/assets/js/script.js'}}"></script>
    <script src="{{config('app.url').'/assets/js/darkmode.js'}}" defer></script>
    <script src="{{ config('app.url').'/assets/js/menu-dropdown.js' }}"></script>
    <!-- Custom Script -->

    <script>
        $(document).ready(function(){
            AOS.init({
                once:true
            });
            $('.select2').select2();
            $('.equal-height').matchHeight();
            $('.equal-height-item').matchHeight();
            $('.equal-height-title').matchHeight();
            $('.equal-height-description').matchHeight();
        });
    </script>
    @stack('script')
</body>
</html>