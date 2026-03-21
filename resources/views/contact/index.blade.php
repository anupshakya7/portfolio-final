@extends('layout.web')
@section('title', 'Contact Anup Shakya | Get in Touch for Freelance & Collaboration')
@section('description', 'Reach out for freelance projects, collaborations, or inquiries. I’ll get back to you as soon as
    possible.')
    @push('css')
        <style>
            .contact-container {
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                text-align: center;
            }

            .contact-content-container {
                width: 80%;
            }

            .contact-form-content {
                margin-top: 20px;
                display: flex;
                justify-content: space-between;
                width: 100%;
                border-radius: 5px;
                padding: 20px;
            }

            .contact-content-box {
                display: flex;
                align-content: center;
                border: 1px solid grey;
                width: 100%;
                margin: 0px 10px;
                flex-direction: column;
                padding: 5px 25px;
                border-radius: 10px;
                text-align: left;
            }

            .contact-box-padding {
                padding: 25px;
                line-height: 32px;
                width: 70%;
                height: 100%;
            }

            .contact-items-container {
                margin-top: 30px;
            }

            .contact-items-container .contact-items {
                margin: 15px 0px;
                padding: 5px 15px;
                border: 1px solid grey;
                border-radius: 5px;
                text-align: left;
            }

            .contact-items-container .contact-items i {
                margin-right: 10px;
            }

            a:hover {
                text-decoration: none;
            }

            .contact-details-container form {
                gap: 5px !important;
            }

            .g-recaptcha{
                margin: 10px 0px;
            }

            .error_message {
                color: #b10707;
                margin-left: 5px;
                font-size: 14px;
            }

            .required {
                color: #b10707;
                margin: 0px 5px;
            }

            @media(max-width: 1086px){
                .contact-form-content{
                    flex-wrap: wrap;
                }

                .contact-box-padding{
                    width:100%;
                }

                .contact-content-box{
                    margin: 10px 0px;
                }

            }
        </style>
    @endpush
@section('content')
    <section id="blog-breadcrumb-section">
        <div class="breadcrumb" style="background-image:url({{ set_url('assets/images/banner/contact-banner.jpg') }})">
            <div class="breadcrumb-inner">
                <h1 style="color: #fff">Contact</h1>
                <div class="breadcrumb-inner-wrapper" style="color: #fff">
                    <a href="{{ route('home') }}" style="color: #fff"><span><i class="fa-solid fa-house"></i>Home</span></a>
                    <span> - </span>
                    <span>Contact</span>
                </div>
            </div>
        </div>
    </section>
    <section id="contact-list-section" data-aos="fade-left" data-aos-delay="200" data-aos-duration="1000">
        <div class="contact-details-container contact-container">
            <div class="contact-content-container">
                <h1>Get In Touch</h1>
                <p>We’d love to hear from you! Whether you have a question, feedback, or just want to connect, feel free to
                    reach out using the form below or through our contact details.</p>
            </div>
            <div class="contact-form-content">
                <div class="contact-content-box contact-box-padding">
                    <h2>Let’s Connect</h2>
                    <p style="margin-top: 5px;">If you have any questions, feedback, or business inquiries, please don’t
                        hesitate to reach out.</p>
                    <p>Fill out the form, and I will respond as soon as possible.</p>
                    <div class="contact-items-container">
                        <div class="contact-items">
                            <a href="mailto:anupshk39@gmail.com">
                                <i class="fa-solid fa-envelope"></i>
                                <span>
                                    anupshk39@gmail.com
                                </span>
                            </a>
                        </div>
                        <div class="contact-items">
                            <a href="https://www.linkedin.com/in/anup-shakya7/" target="_blank">
                                <i class="fa-brands fa-linkedin"></i>
                                <span>https://www.linkedin.com/in/anup-shakya7/</span>
                            </a>
                        </div>
                        <div class="contact-items">
                            <a href="tel:9860172265">
                                <i class="fa-solid fa-phone"></i>
                                <span>
                                    +977-9860172265
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="contact-content-box">
                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        <label for="fullname">Full Name<span class="required">*</span></label>
                        <input type="text" name="name" value="{{ old('name') }}" id="fullname"
                            placeholder="Enter your Fullname" />
                        @error('name')
                            <span class="error_message" id="fullname">{{ $message }}</span>
                        @enderror

                        <label for="email">Email Address<span class="required">*</span></label>
                        <input type="text" name="email" value="{{ old('email') }}" id="email"
                            placeholder="Enter your Email Address" />
                        @error('name')
                            <span class="error_message" id="email">{{ $message }}</span>
                        @enderror

                        <label for="phone">Phone Number</label>
                        <input type="text" name="phone" value="{{ old('phone') }}" id="phone"
                            placeholder="Enter your Phone Number" maxlength="10" />
                        @error('phone')
                            <span class="error_message" id="phone">{{ $message }}</span>
                        @enderror

                        <label for="">Subject / Reason for Contact<span class="required">*</span></label>
                        <select name="subject">
                            <option value="">Select Subject / Reason for Contact</option>
                            <option value="general_inquiry" {{ old('subject') == 'general_inquiry' ? 'selected' : '' }}>
                                General Inquiry</option>
                            <option value="freelance_project" {{ old('subject') == 'freelance_project' ? 'selected' : '' }}>
                                Freelance Project</option>
                            <option value="collaboration" {{ old('subject') == 'collaboration' ? 'selected' : '' }}>
                                Collaboration</option>
                            <option value="job_opportunity" {{ old('subject') == 'job_opportunity' ? 'selected' : '' }}>Job
                                Opportunity</option>
                            <option value="other" {{ old('subject') == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                        @error('subject')
                            <span class="error_message" id="subject">{{ $message }}</span>
                        @enderror

                        <label for="message">Message<span class="required">*</span></label>
                        <textarea name="message" id="message" cols="30" rows="10" placeholder="Enter your Message..."></textarea>
                        @error('message')
                            <span class="error_message" id="message"></span>
                        @enderror

                        <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>
                        <span class="error_message" id="recaptcha_error"></span>
                        @error('captcha')
                            <span class="error_message">{{ $message }}</span>
                        @enderror

                        <div class="gpa-button-wrapper">
                            <button class="btn-tool" type="submit"><i class="fa-solid fa-envelope"></i> Contact Us</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('script')
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.querySelector('form').addEventListener("submit", function(e) {
            let recaptcha = grecaptcha.getResponse();

            if (recaptcha.length === 0) {
                e.preventDefault();
                document.getElementById("recaptcha_error").innerText = "Please verify that you are not a robot."
            }
        });
    </script>
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                confirmButtonText: 'OK'
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: '{{ session('error') }}',
                confirmButtonText: 'OK'
            });
        </script>
    @endif
@endpush
