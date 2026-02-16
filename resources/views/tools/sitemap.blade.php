@extends('layout.web')
@section('title', 'Free XML Sitemap Generator Tool – Create SEO Sitemap Online')
@section('description', 'Generate XML sitemaps instantly with our free Sitemap Generator tool. Improve search engine indexing, boost SEO rankings, and submit your sitemap to Google easily.')
@push('css')
    <style>
        #sitemap-form{
            gap: 3px;
        }

        .blog-single-container h4{
            padding-left: 0px; 
        }
        
        section {
            padding-top: 10vh;
        }

        .gpa-button-wrapper{
            margin-top: 20px;
        }

        .required{
            color: #b10707;
            margin: 0px 5px;
        }

        #url_box, #wifi_box{
            display: flex;
            flex-direction: column;
        }
        

        .qr-result {
            display: none;
            justify-content: center;
            align-content: center;
        }

        i{
            margin-right: 4px;
        }

        .error_message {
            color: #b10707;
            margin-left: 5px;
            font-size: 14px;
        }

        @media (max-width: 935px){
            .blog-single-container p{
                padding: 0px;
                text-align: center;
            }
        }
        
    </style>
@endpush
@section('content')
    <!-- Breadcrumb -->
     @include('partials.breadcrumb',['mainTitle' => 'Sitemap','parentTitle' => 'Tools','parentUrl' => route('tool.index'),'slug' => 'sitemap-generator'])
    <section id="blog-list-section" data-aos="fade-left" data-aos-delay="200" data-aos-duration="1000">
        <div class="blog-single-container">
            <div class="gpa-converter-wrapper">
                <h2>Generate Sitemap</h2>
                <form action="{{ route('tool.sitemap.generate.submit') }}" method="POST" id="sitemap-form" enctype="multipart/form-data">
                    @csrf
                    <div id="url_box">
                        <label for="website_url">Website Url<span class="required">*</span></label>
                        <input type="text" id="website_url" name="website_url"
                            placeholder="Enter your website url" />
                        <span class="error_message" id="url_error"></span>
                    </div>
                    <div class="gpa-button-wrapper">
                        <button type="submit" id="sitemap_btn"><i class="fa-solid fa-sitemap"></i>Generate Sitemap</button>
                    </div>
                </form>
            </div>
            <div class="gpa-converter-wrapper qr-result">
                <h4>
                    Your Custom QR Code
                </h4>
                <p>
                    Scan the QR code below or download it to share anywhere. Your logo is beautifully integrated in the
                    center.
                </p>
                <img src="{{ asset('assets/images/logo.png') }}" alt="QR Result">
                <button id="download-qr"><i class="fa-solid fa-download"></i>Download QR</button>
                <p>
                    Click the button above to download the QR code.
                </p>
            </div>
        </div>
    </section>
@endsection
@push('script')
    <script>

    </script>
@endpush
