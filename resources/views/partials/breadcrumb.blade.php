<section id="blog-breadcrumb-section">
    @php
        $tool = isset($slug) ? \App\Toolset::where('slug',$slug)->first() : null;
        
        if($tool && $tool->banner){
            $banner = set_storage_url($tool->banner);
        }else{
            $banner = set_url('assets/images/banner/banner.jpg');
        }
    @endphp
    <div class="breadcrumb" style="background-image:url('{{ $banner }}')">
        <div class="breadcrumb-inner">
            <h1 style="color: #fff">{{ $mainTitle }}</h1>
            <div class="breadcrumb-inner-wrapper" style="color:#fff;">
                <a href="{{ route('home') }}" style="color: #fff"><span><i class="fa-solid fa-house"></i>Home</span></a>
                <span> - </span>
                @if(isset($parentUrl))
                <a href="{{ $parentUrl }}" style="color: #fff"><span>{{ $parentTitle }}</span></a>
                <span> - </span>
                @endif
                <span>{{ $mainTitle }}</span>
            </div>
        </div>
    </div>
</section>