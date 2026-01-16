@extends('layout.web')
@section('content')
<section id="blog-breadcrumb-section">
    <div class="breadcrumb" style="background-image:url('{{ set_url('assets/images/banner/tool-banner.jpg') }}')">
        <div class="breadcrumb-inner">
            <h1 style="color: #000">QR Generator</h1>
            <div class="breadcrumb-inner-wrapper">
                <a href="{{ route('home') }}" style="color: #000"><span><i class="fa-solid fa-house"></i>Home</span></a>
                <span> - </span>
                <span>QR Generator</span>
            </div>
        </div>
    </div>
</section>
<section id="blog-list-section">
    <div class="blog-single-container">
        <div class="gpa-converter-wrapper">
            <h2>Generate QR Code</h2>
            <form action="{{ route('tool.qr-code.submit') }}" method="POST">
                @csrf
                <input type="text" name="url" id="link" placeholder="Enter your link"/>
                <div class="gpa-button-wrapper">
                    <button type="submit" id="qr_code_btn">Generate QR</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
@push('script')

@endpush