@extends('layout.web')
@section('content')
<section id="blog-breadcrumb-section">
    <div class="breadcrumb" style="background-image:url('{{ set_storage_url($single->banner) }}')">
        <div class="breadcrumb-inner">
            <h1 style="color: #000">{{$single->title}}</h1>
            <div class="breadcrumb-inner-wrapper">
                <a href="{{ route('home') }}" style="color: #000"><span><i class="fa-solid fa-house"></i>Home</span></a>
                <span> - </span>
                <span>{{$single->title}}</span>
            </div>
        </div>
    </div>
</section>
<section id="blog-list-section">
    <div class="blog-single-container">
        {!! $single->description !!}

    </div>
</section>
@endsection