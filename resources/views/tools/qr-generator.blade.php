@extends('layout.web')
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

        .qr-result {
            display: none;
            justify-content: center;
            align-content: center;
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
        
    </style>
@endpush
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
                <form id="qr-form" enctype="multipart/form-data">
                    @csrf
                    <label for="url">Url<span class="required">*</span></label>
                    <input type="text" name="url" id="url" oninput="$('.error_message').text('')"
                        placeholder="Enter your url" />
                    <span class="error_message"></span>

                    <label for="logo">Logo<span> (Optional)</span></label>
                    <input type="file" name="logo" id="logo" accept="image/png, image/jpeg" />
                    <span class="error_message"></span>

                    <label for="color">Color<span> (Optional)</span></label>
                    <input type="color" name="color" id="color" value="#000000" />
                    <span class="error_message"></span>

                    <div class="gpa-button-wrapper">
                        <button type="submit" id="qr_code_btn">Generate QR</button>
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
                <button id="download-qr"><i class="fa-solid fa-download" style="margin-right: 4px;"></i>Download QR</button>
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

                let formData = new FormData(this);
                console.log('formData:',formData);

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
                        } else {
                            alert('Something went wrong');
                        }
                    },
                    complete: function() {
                        $('#qr_code_btn').text('Generate QR').prop('disabled', false);
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
        });
    </script>
@endpush
