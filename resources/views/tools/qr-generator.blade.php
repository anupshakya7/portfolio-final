@extends('layout.web')
@section('title', 'Free QR Code Generator Online | URL, WiFi, Text & Logo QR')
@section('description', 'Generate free QR codes instantly for URLs, WiFi, text, email & more. Customize colors, add logo, download high-quality QR codes online.')
@push('css')
    <style>
        #qr-form{
            gap: 3px;
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

        .qr-result img {
            max-width: 350px;
            border: 1px solid grey;
            border-radius: 10px;
            margin: 25px 0 !important;
            box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
        }

        .error_message {
            color: #b10707;
            margin-left: 5px;
            font-size: 14px;
        }

        #download-qr{
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

        #download-qr:hover{
            background-color: #2c68a0;
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
     @include('partials.breadcrumb',['mainTitle' => 'QR Code','parentTitle' => 'Tools','parentUrl' => route('tool.index'),'slug' => 'qr-code'])
    <section id="blog-list-section">
        <div class="blog-single-container">
            <div class="gpa-converter-wrapper">
                <h2>Generate QR Code</h2>
                <form id="qr-form" enctype="multipart/form-data">
                    @csrf
                    <label for="">QR Type<span class="required">*</span></label>
                    <select id="qr_type">
                        <option value="url">URL</option>
                        <option value="wifi">Wifi</option>
                    </select>


                    <div id="url_box">
                        <label for="url">Url<span class="required">*</span></label>
                        <input type="text" id="url"
                            placeholder="Enter your url" />
                        <span class="error_message" id="url_error"></span>
                    </div>

                    <div id="wifi_box" style="display: none;">
                        <label for="url">Wifi Name (SSID)<span class="required">*</span></label>
                        <input type="text" id="ssid"
                            placeholder="Enter your Wifi Name (SSID)" />
                        <span class="error_message" id="ssid_error"></span>

                        <label for="password">Wifi Password<span> (Optional)</span></label>
                        <input type="text" id="password"
                            placeholder="Enter your Wifi Password" />
                        <span class="error_message" id="password_error"></span>

                        <label for="security">Security<span class="required">*</span></label>
                        <select id="security">
                            <option value="WPA">WPA/WPA2</option>
                            <option value="WEP">WEP</option>
                            <option value="nopass">No Password</option>
                        </select>
                        <span class="error_message" id="ssid_error"></span>
                    </div>
                  

                    <label for="logo">Logo<span> (Optional)</span></label>
                    <input type="file" id="logo" accept="image/png, image/jpeg" />
                    <span class="error_message"></span>

                    <label for="color">Color<span> (Optional)</span></label>
                    <input type="color" id="color" value="#000000" />
                    <span class="error_message"></span>

                    <div class="gpa-button-wrapper">
                        <button type="submit" id="qr_code_btn"><i class="fa-solid fa-qrcode"></i>Generate QR</button>
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
        $(document).ready(function() {
            let latestQr = "";
            
            //Generate QR
            $('#qr-form').submit(function(e) {
                e.preventDefault();
                $('.qr-result').css('display', 'none');
                $('.error_message').text('');
                // let token = $('meta[name="csrf-token"]').attr('content');
                // let url = $('#url').val();

                let formData = new FormData();

                formData.append('_token',"{{ csrf_token() }}");
                formData.append('type',$('#qr_type').val());
                formData.append('color',$('#color').val());
                formData.append('logo',$('#logo')[0].files[0]);

                if($('#qr_type').val() === 'wifi'){
                    formData.append('ssid', $('#ssid').val());
                    formData.append('password',$('#password').val());
                    formData.append('security',$('#security').val());
                }else{
                    formData.append('url', $('#url').val());
                }

                $.ajax({
                    url: "{{ route('tool.qr-code.submit') }}",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $('#qr_code_btn').text('Generating...').prop('disabled', true);
                    },
                    success: function(response) {
                        $('.qr-result img').attr('src', response.qr);
                        $('.qr-result').css('display', 'flex');

                        latestQr = response.qr;
                    },
                    error: function(xhr) {
                        $('.qr-result').css('display', 'none');
                        
                        if (xhr.status === 422) {
                            
                            const errors = xhr.responseJSON.errors;
                            $('.error_message').text('');
                            if(errors.url) $('#url').next('.error_message').text(errors.url);
                            else if(errors.logo) $('#logo').next('.error_message').text(errors.logo);
                            else if(errors.color) $('#color').next('.error_message').text(errors.color);
                            else if(errors.ssid) $('#ssid').next('.error_message').text(errors.ssid);
                            else if(errors.security) $('#security').next('.error_message').text(errors.security);
                        } else {
                            alert('Something went wrong');
                        }
                    },
                    complete: function() {
                        $('#qr_code_btn').html('<i class="fa-solid fa-qrcode"></i>Generate QR').prop('disabled', false);
                    }
                });
            });

            //Download QR
            $('#download-qr').click(function(){
                if(!latestQr){
                    alert('Please generate a QR code first!!!');
                    return;
                }

                const a = document.createElement('a');
                a.href = latestQr;
                a.download = 'qr-code.png';
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
            });

            //QR Type Dropdown
            $('#qr_type').change(function(){
                $('.error_message').text('');

                if($(this).val() === 'wifi'){
                    clearBox('#url_box');
                    $('#url_box').hide();
                    $('#wifi_box').show();
                }else{
                    clearBox('#wifi_box');
                    $('#url_box').show();
                    $('#wifi_box').hide();
                }
            });

            function clearBox(box){
                $(box).find('input, textarea').val('');
            }
        });
    </script>
@endpush
