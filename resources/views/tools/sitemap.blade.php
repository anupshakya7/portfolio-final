@extends('layout.web')
@section('title', 'Free XML Sitemap Generator Tool – Create SEO Sitemap Online')
@section('description',
    'Generate XML sitemaps instantly with our free Sitemap Generator tool. Improve search engine
    indexing, boost SEO rankings, and submit your sitemap to Google easily.')
    @push('css')
        <style>
            #sitemap-form {
                gap: 3px;
            }

            .blog-single-container h4 {
                padding-left: 0px;
            }
            
            .blog-single-container p{
                text-align: center;
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

            #url_box,
            #wifi_box {
                display: flex;
                flex-direction: column;
            }


            .sitemap-result {
                display: none;
                justify-content: center;
                align-content: center;
            }

            i {
                margin-right: 4px;
            }

            .sitemap-container {
                width: 90%;
                display: flex;
                justify-content: space-around;
                border: 1px solid #808080;
                border-radius: 10px;
                padding: 10px;
                margin: 20px 0px;
                gap: 10px;
                box-shadow: rgba(50, 50, 93, 0.25) 0px 30px 60px -12px inset, rgba(0, 0, 0, 0.3) 0px 18px 36px -18px inset;
            }

            .error_message {
                color: #b10707;
                margin-left: 5px;
                font-size: 14px;
            }

            .tool-btn {
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

            #download-sitemap {
                background-color: #01a6eb;
            }

            #download-sitemap:hover {
                background-color: #2c68a0;
            }

            #view-sitemap {
                background-color: #ff4d00;
            }

            #view-sitemap:hover {
                color: #fff;
                background-color: rgb(107, 57, 17);
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
        'mainTitle' => 'Sitemap',
        'parentTitle' => 'Tools',
        'parentUrl' => route('tool.index'),
        'slug' => 'sitemap-generator',
    ])
    <section id="blog-list-section" data-aos="fade-left" data-aos-delay="200" data-aos-duration="1000">
        <div class="blog-single-container">
            <div class="gpa-converter-wrapper">
                <h2>Generate Sitemap</h2>
                <form id="sitemap-form"
                    enctype="multipart/form-data">
                    @csrf
                    <div id="url_box">
                        <label for="website_url">Website Url<span class="required">*</span></label>
                        <input type="text" id="website_url" name="website_url" placeholder="Enter your website url" />
                        <span class="error_message" id="url_error"></span>
                    </div>
                    <div class="gpa-button-wrapper">
                        <button type="submit" id="sitemap_btn"><i class="fa-solid fa-sitemap"></i>Generate Sitemap</button>
                    </div>
                </form>
            </div>
            <div class="gpa-converter-wrapper sitemap-result">
                <h4>
                    Your Sitemap is Ready
                </h4>
                <p>
                    Your sitemap has been successfully generated. You can preview it in your browser
                    or download the XML file to submit to search engines like Google or Bing.
                </p>
                <div class="sitemap-container">
                    <p id="sitemap-url"></p>
                    <div>
                        <a class="tool-btn" target="__blank" id="view-sitemap"><i class="fa-solid fa-eye"></i>View Sitemap</a>
                        <button class="tool-btn" id="download-sitemap"><i class="fa-solid fa-download"></i>Download
                            Sitemap</button>
                    </div>
                </div>
                <p>
                    After downloading, you can upload this file to your website root directory
                    or submit the sitemap URL inside Google Search Console.
                </p>
            </div>
        </div>
    </section>
@endsection
@push('script')
<script>
    $(document).ready(function(){
        let sitemap = "";

        $('#sitemap-form').submit(function(e){
            e.preventDefault();
            $('.sitemap-result').css('display', 'none');
            $('.error_message').text('');

            let formData = new FormData();

            formData.append('_token',"{{ csrf_token() }}");
            formData.append('website_url',$('#website_url').val());

            $.ajax({
                url: "{{ route('tool.sitemap.generate.submit') }}",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function(){
                    $('#sitemap_btn').text('Generating...').prop('disabled',true);
                },
                success: function(response){
                    $('.sitemap-result #sitemap-url').text(response.file);
                    $('.sitemap-result').css('display','flex');
                    $('#view-sitemap').attr('href',response.file);

                    sitemap = response.file;
                },
                error: function(xhr){
                    $('.sitemap-result').css('display','none');
                    $('#view-sitemap').attr('href','');

                    if(xhr.status === 422){
                        const errors = xhr.responseJSON.errors;
                        $('.error_message').text('');
                        if(errors.website_url) $('#website_url').next('.error_message').text(errors.website_url);
                    }else{
                        alert('Something went wrong');
                    }
                },
                complete: function(){
                    $('#sitemap_btn').html('<i class="fa-solid fa-sitemap"></i>Generate Sitemap').prop('disabled', false);
                }
            })
        });

        $('#download-sitemap').click(function(){
            if(!sitemap){
                alert("Please generate Sitemap first!!!");
            }

            const a = document.createElement('a');
            a.href = sitemap;
            a.download = 'sitemap.xml';
            document.body.appendChild(a);

            a.click();
            document.body.removeChild(a);
        });
    });
</script>
@endpush
