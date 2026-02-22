@extends('layout.web')
@section('title', 'Free QR Code Generator Online | URL, WiFi, Text & Logo QR')
@section('description', 'Generate free QR codes instantly for URLs, WiFi, text, email & more. Customize colors, add
    logo, download high-quality QR codes online.')
    @push('css')
        <style>
            #robots-form {
                gap: 3px;
            }

            .blog-single-container h4 {
                padding-left: 0px;
            }

            section {
                padding-top: 10vh;
            }

            .gpa-button-wrapper {
                margin-top: 20px;
            }

            .required {
                color: #b10707;
                margin: 0px 5px;
            }

            .robots-preview {
                display: flex;
                justify-content: center;
                align-content: center;
                border: 1px solid grey;
                padding:10px;
                border-radius: 10px;
                margin: 20px 0px;
            }

            i {
                margin-right: 4px;
            }

            .error_message {
                color: #b10707;
                margin-left: 5px;
                font-size: 14px;
            }

            #download-robots {
                display: inline;
                background-color: #01a6eb;
                color: #ffffff;
                padding: 10px 13px;
                border: none;
                font-size: 16px;
                font-weight: bold;
                border-radius: 8px;
                transition: 0.2s ease-in-out;
                cursor: pointer;
            }

            #download-robots:hover {
                background-color: #2c68a0;
            }

            @media (max-width: 935px) {
                .blog-single-container p {
                    padding: 0px;
                    text-align: center;
                }
            }
        </style>
    @endpush
@section('content')
    <!-- Breadcrumb -->
    @include('partials.breadcrumb', [
        'mainTitle' => 'Robots.txt Generator',
        'parentTitle' => 'Tools',
        'parentUrl' => route('tool.index'),
        'slug' => 'robots-generator',
    ])
    <section id="blog-list-section" data-aos="fade-left" data-aos-delay="200" data-aos-duration="1000">
        <div class="blog-single-container">
            <div class="gpa-converter-wrapper">
                <h2>Generate Robots.txt</h2>
                <form id="robots-form" enctype="multipart/form-data">
                    @csrf
                    <label for="">QR Type<span class="required">*</span></label>
                    <select id="qr_type">
                        <option value="url">URL</option>
                        <option value="wifi">Wifi</option>
                    </select>
                    <div>
                        <label for="url">Url<span class="required">*</span></label>
                        <input type="text" id="url" placeholder="Enter your url" />
                        <span class="error_message" id="url_error"></span>
                    </div>


                    <div class="gpa-button-wrapper">
                        <button type="submit" id="qr_code_btn"><i class="fa-solid fa-qrcode"></i>Generate QR</button>
                    </div>
                </form>
            </div>
            <div class="gpa-converter-wrapper robots-result">
                <h4>
                    Your Generated robots.txt File
                </h4>
                <p>
                    Below is your generated robots.txt configuration. Review it carefully and download it to upload to your
                    website’s root directory.
                </p>

                <div class="robots-preview">
                    <pre>{{ $content ?? "User-agent: *\nDisallow:\nSitemap: https://yourdomain.com/sitemap.xml" }}</pre>
                </div>

                <button id="download-robots">
                    <i class="fa-solid fa-download"></i> Download robots.txt
                </button>

                <p>
                    After downloading, upload this file to:
                    <strong>https://yourdomain.com/robots.txt</strong>
                </p>
            </div>
        </div>
    </section>
@endsection
@push('script')
@endpush
