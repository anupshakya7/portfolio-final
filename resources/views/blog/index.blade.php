@extends('layout.web')
@section('content')
<section id="blog-breadcrumb-section">
    <div class="breadcrumb" style="background-image:url('https://ausstudies.com/storage/pages/July2023/S3nqPRrqSXMD8g4AUXJc.png')">
        <div class="breadcrumb-inner">
            <h1>Blog</h1>
            <div class="breadcrumb-inner-wrapper">
                <a href="{{ route('home') }}"><span><i class="fa-solid fa-house"></i>Home</span></a>
                <span> - </span>
                <span>Blog</span>
            </div>
        </div>
    </div>
</section>
<section id="blog-list-section">
    <div class="blogs-details-container blog-containers">
        @foreach($blogs as $blog)
        @php
            $blogImage = $blog->thumbnail !== null ? set_storage_url($blog->thumbnail) : set_url('/assets/images/project-1.png');
        @endphp
        <div class="details-container color-container equal-height">
            <div class="article-container equal-height-item">
                <img src="{{ $blogImage }}" alt="Hello World" class="project-img"/>
            </div>
            <h2 class="blogs-sub-title project-title equal-height-title">{{$blog->title}}</h2>
            <p class="blog-description equal-height-description">{{Str::limit($blog->excerpt,100)}}</p>
            <div class="btn-container blog-footer">
                <button class="btn btn-color-2 project-btn" onclick="window.open('','_blank');">
                    Read More
                </button>
                <p><i class="fa-solid fa-calendar"></i>{{ \Carbon\Carbon::parse($blog->created_at)->format('d F, Y')}}</p>
            </div>
        </div>
        @endforeach
    </div>
    <div class="pagination">
        {{ $blogs->links() }}
    </div>
</section>
@endsection