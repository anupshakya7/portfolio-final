@extends('layout.web')
@section('title', 'Free QR Code Generator Online | URL, WiFi, Text & Logo QR')
@section('description',
    'Generate free QR codes instantly for URLs, WiFi, text, email & more. Customize colors, add
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
                padding: 10px;
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

            .user-agent-container {
                display: flex;
                justify-content: center;
                align-items: center;
                padding: 30px 20px;
                flex-direction: column;
                border: 1px solid #808080;
                border-radius: 10px;
            }

            .user-agent-container div {
                display: flex;
                flex-direction: column;
                width: 100%;
            }

            .btn-tool {
                display: inline;
                color: #ffffff;
                padding: 10px 13px;
                border: none;
                font-size: 16px;
                font-weight: bold;
                border-radius: 8px;
                transition: 0.2s ease-in-out;
                cursor: pointer;
            }

            #download-robots {
                background-color: #01a6eb;
            }

            #download-robots:hover {
                background-color: #2c68a0;
            }

            #add_useragent_btn {
                float: right;
            }

            #remove_allow {
                background-color: #dc2626;
            }

            #remove_allow:hover {
                background-color: #b91c1c;
            }

            .gpa-converter-wrapper label {
                margin-top: 7px;
            }

            .field-with-delete{
                display:flex !important;
                flex-direction: row !important; 
                gap:10px;
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
                <form>
                    <div>
                        <button class="btn-tool" id="add_useragent_btn"><i class="fa-solid fa-plus"></i>Add User Agent</button>
                    </div>
                    <div class="user-agent-container">
                        <div>
                            <label for="">User Agent<span class="required">*</span></label>
                            <select id="user_agent">
                                <option value="">User Agent</option>
                                <option value="*">*</option>
                                <option value="googlebot">Googlebot</option>
                            </select>
                        </div>

                        <div id="allow-url-container">
                            <div>
                                <label for="allow">Allow<span class="required">*</span></label>
                                <div class="field-with-delete">
                                    <input type="text" id="allow" placeholder="Enter your allow url" />
                                    <button class="btn-tool" id="remove_allow"><i class="fa-solid fa-trash"></i></button>
                                </div>

                                <span class="error_message" id="allow_url_error"></span>
                            </div>
                        </div>
                        <div>
                            <button class="btn-tool" id="add_allow_btn"><i class="fa-solid fa-plus"></i>Add Allow
                                Url</button>
                        </div>
                        <hr/>

                        <div>
                            <div>
                                <label for="allow">Disallow<span class="required">*</span></label>
                                <div class="field-with-delete">
                                    <input type="text" id="disallow" placeholder="Enter your disallow url" />
                                    <button class="btn-tool" id="remove_disallow"><i class="fa-solid fa-trash"></i></button>
                                </div>
                                
                                <span class="error_message" id="disallow_url_error"></span>
                            </div>
                            <button class="btn-tool" id="add_disallow_btn"><i class="fa-solid fa-plus"></i>Add Disllow
                                Url</button>
                        </div>


                    </div>

                    <div class="gpa-button-wrapper">
                        <button class="btn-tool" type="submit" id="qr_code_btn"><i class="fa-solid fa-robot"></i>Generate
                            Robot
                            Txt</button>
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

                <button class="btn-tool" id="download-robots">
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
