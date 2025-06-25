@extends('layout.web')
@section('title','Blog - Latest Articles, Insights & Updates | Anup Shakya')
@section('description','Explore our latest blog posts covering tips, tutorials, industry insights, and updates to keep you informed and inspired. Stay ahead with expert content.')
@section('content')
<section id="blog-breadcrumb-section">
    <div class="breadcrumb" style="background-image:url({{ set_url('assets/images/banner/blog-banner1.gif') }})">
        <div class="breadcrumb-inner">
            <h1 style="color: #000">Blog</h1>
            <div class="breadcrumb-inner-wrapper">
                <a href="{{ route('home') }}" style="color: #000"><span><i class="fa-solid fa-house"></i>Home</span></a>
                <span> - </span>
                <span>Blog</span>
            </div>
        </div>
    </div>
</section>
<section id="blog-list-section" data-aos="fade-left" data-aos-delay="200" data-aos-duration="1000">
    <div class="blogs-details-container blog-containers">
        @foreach($blogs as $blog)
        @php
            $blogImage = $blog->thumbnail !== null ? set_storage_url($blog->thumbnail) : set_url('/assets/images/project-1.png');
        @endphp
        <div class="details-container color-container equal-height blog_item">
            <div class="article-container equal-height-item">
                <img src="{{ $blogImage }}" alt="Hello World" class="project-img"/>
            </div>
            <h2 class="blogs-sub-title project-title equal-height-title">{{$blog->title}}</h2>
            {{-- <p class="blog-description equal-height-description">{{Str::limit($blog->excerpt,100)}}</p> --}}
            <div class="btn-container blog-footer">
                <button class="btn btn-color-2 project-btn" onclick="location.href = '{{ route('blog.show',$blog->slug) }}'">
                    Read More
                </button>
                <p><i class="fa-solid fa-calendar"></i>{{ \Carbon\Carbon::parse($blog->created_at)->format('d F, Y')}}</p>
            </div>
        </div>
        @endforeach
    </div>
    <div class="pagination">
        {{ $blogs->links('vendor.pagination.custom') }}
    </div>
</section>
@endsection