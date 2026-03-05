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
                width: 70%;
                text-align: center;
                box-shadow: inset rgb(17 17 26 / 21%) 0px 4px 16px, inset rgb(17 17 26 / 0%) 0px 8px 24px, inset rgb(17 17 26 / 0%) 0px 16px 56px;
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

            .allow-item {
                margin-top: 10px;
            }

            .disallow-item {
                margin-top: 10px;
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

            .add_btn_container {
                display: block !important;
                margin-top: 10px;
            }

            #add_useragent_btn {
                float: right;
            }

            .remove {
                background-color: #dc2626 !important;
            }

            .remove:hover {
                background-color: #b91c1c !important;
            }

            .gpa-converter-wrapper label {
                margin-top: 7px;
            }

            .field-with-delete {
                display: flex !important;
                flex-direction: row !important;
                gap: 10px;
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
                    {{-- <div>
                        <button class="btn-tool" id="add_useragent_btn"><i class="fa-solid fa-plus"></i>Add User Agent</button>
                    </div> --}}
                    <div class="user-agent-container">
                        <div>
                            <label for="">User Agent<span class="required">*</span></label>
                            <select id="user_agent">
                                <option value="">User Agent</option>
                                <optgroup label="All Crawlers">
                                    <option value="*">*</option>
                                </optgroup>

                                <optgroup label="Search Engines">
                                    <option value="Googlebot">Googlebot</option>
                                    <option value="Bingbot">Bingbot</option>
                                    <option value="Slurp">Yahoo Slurp</option>
                                    <option value="DuckDuckBot">DuckDuckBot</option>
                                    <option value="Baiduspider">Baiduspider</option>
                                    <option value="YandexBot">YandexBot</option>
                                </optgroup>

                                <optgroup label="Social Media">
                                    <option value="facebookexternalhit">Facebook</option>
                                    <option value="Twitterbot">Twitter</option>
                                    <option value="LinkedInBot">LinkedIn</option>
                                </optgroup>

                                <optgroup label="AI Crawlers">
                                    <option value="GPTBot">GPTBot</option>
                                    <option value="ClaudeBot">ClaudeBot</option>
                                    <option value="CCBot">CCBot</option>
                                </optgroup>
                            </select>
                        </div>

                        <div id="allow-url-container">
                            <div>
                                <label for="allow">Allow<span class="required">*</span></label>
                                <div id="allow-multiple-url-container">
                                    <div class="allow-item">
                                        <div class="field-with-delete">
                                            <input type="text" class="allow-input" placeholder="Enter your allow url" />
                                            <button class="btn-tool remove"><i class="fa-solid fa-trash"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <span class="error_message" id="allow_url_error"></span>
                            </div>
                        </div>
                        <div class="add_btn_container">
                            <button class="btn-tool" id="add_allow_btn"><i class="fa-solid fa-plus"></i>Add Allow
                                Url</button>
                        </div>
                        <hr />

                        <div id="disallow-url-container">
                            <div>
                                <label for="allow">Disallow<span class="required">*</span></label>
                                <div id="disallow-multiple-url-container">
                                    <div class="disallow-item">
                                        <div class="field-with-delete">
                                            <input type="text" class="disallow-input"
                                                placeholder="Enter your disallow url" />
                                            <button class="btn-tool remove"><i class="fa-solid fa-trash"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <span class="error_message" id="disallow_url_error"></span>
                            </div>
                        </div>
                        <div class="add_btn_container">
                            <button class="btn-tool" id="add_disallow_btn"><i class="fa-solid fa-plus"></i>Add Disllow
                                Url</button>
                        </div>


                        <div>
                            <label for="sitemap">Sitemap URL<span class="required">*</span></label>
                            <div class="field-with-delete">
                                <input type="text" id="sitemap" placeholder="Enter your sitemap url" />
                                {{-- <button class="btn-tool remove"><i class="fa-solid fa-trash"></i></button> --}}
                            </div>

                            <span class="error_message" id="disallow_url_error"></span>
                        </div>
                    </div>

                    <div class="gpa-button-wrapper">
                        <button class="btn-tool" type="submit" id="robot_generate_btn"><i
                                class="fa-solid fa-robot"></i>Generate
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
    <script>
        //Add Allow Url
        document.getElementById('add_allow_btn').addEventListener("click", function(e) {
            e.preventDefault();

            const container = document.getElementById('allow-multiple-url-container');

            const html = `
                <div class="allow-item">
                    <div class="field-with-delete">
                        <input type="text" class="allow-input" placeholder="Enter your allow url">
                        <button type="button" class="btn-tool remove">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </div>
                </div>
            `;

            container.insertAdjacentHTML("beforeend", html);
        });

        //Add Disallow Url
        document.getElementById("add_disallow_btn").addEventListener("click", function(e) {
            e.preventDefault();

            const container = document.getElementById("disallow-multiple-url-container");

            const html = `
                <div class="disallow-item">
                    <div class="field-with-delete">
                        <input type="text" class="disallow-input" placeholder="Enter your disallow url">
                        <button type="button" class="btn-tool remove">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </div>
                </div>
            `;

            container.insertAdjacentHTML("beforeend", html);
        });

        //Remove Field
        document.addEventListener('click', function(e) {
            if (e.target.closest('.remove')) {
                const field = e.target.closest(".allow-item, .disallow-item");
                if (field) {
                    field.remove();
                }
            }
        });

        document.getElementById('robot_generate_btn').addEventListener("click", function(e) {
            e.preventDefault();

            const userAgent = document.getElementById('user_agent').value;
            const sitemap = document.getElementById('sitemap').value;

            const allowInputs = document.querySelectorAll('.allow-input');
            const disallowInputs = document.querySelectorAll('.disallow-input');

            let robotsTxt = "";

            if (!userAgent) {
                alert('Please select a User Agent');
                return;
            }

            robotsTxt += "User-agent: " + userAgent + "\n";

            allowInputs.forEach(input => {
                let value = input.value.trim();
                if (value !== "") {
                    if (!value.startsWith("/")) {
                        value = "/" + value;
                    }
                    robotsTxt += "Allow: " + value + "\n";
                }
            });

            disallowInputs.forEach(input => {
                let value = input.value.trim();
                if (value !== "") {
                    if (!value.startsWith("/")) {
                        value = "/" + value;
                    }
                    robotsTxt += "Disallow: " + value + "\n";
                }
            });

            if (sitemap) {
                robotsTxt += "\nSitemap: " + sitemap;
            }

            document.querySelector('.robots-preview pre').textContent = robotsTxt;
        });

        // document.getElementById('')
    </script>
@endpush
