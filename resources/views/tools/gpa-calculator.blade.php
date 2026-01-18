@extends('layout.web')
@section('content')
<section id="blog-breadcrumb-section">
    <div class="breadcrumb" style="background-image:url('{{ set_url('assets/images/banner/tool-banner-main.jpg') }}')">
        <div class="breadcrumb-inner">
            <h1 style="color: #000">GPA Calculator</h1>
            <div class="breadcrumb-inner-wrapper">
                <a href="{{ route('home') }}" style="color: #000"><span><i class="fa-solid fa-house"></i>Home</span></a>
                <span> - </span>
                <span>GPA Calculator</span>
            </div>
        </div>
    </div>
</section>
<section id="blog-list-section">
    <div class="blog-single-container">
        <div class="gpa-converter-wrapper">
            <h2>GPA to Percentage Tool</h2>
            <form>
                <input type="text" id="gpa_text" placeholder="Enter your GPA"/>
                <div class="gpa-button-wrapper">
                    <button type="button" id="gpa_convert_btn">Convert</button>
                </div>
            </form>
            <div id="gpa_ans">
                
            </div>
        </div>
    </div>
</section>
@endsection
@push('script')
<script>
    $(document).ready(function () {
        function convertGPA(){
           let gpa_text = $('#gpa_text').val();
            let percentages = gpa_text * 25;
			let percentage = percentages.toFixed(2);

            if (gpa_text != '') {
                if (gpa_text <= 4 && gpa_text >= 0) {
                    if (gpa_text <= 4 && gpa_text >= 3.6) {
                        $('#gpa_ans').removeClass('text-danger');
                        $('#gpa_ans').addClass('text-success');
                        $('#gpa_ans').html('Your Grade is A+ <br>Outstanding Result <br>Your Percentage is ' + percentage + '%');
                    } else if (gpa_text < 3.6 && gpa_text >= 3.2) {
                        $('#gpa_ans').removeClass('text-danger');
                        $('#gpa_ans').addClass('text-success');
                        $('#gpa_ans').html('Your Grade is A <br>Excellent Result <br>Your Percentage is ' + percentage + '%');
                    } else if (gpa_text < 3.2 && gpa_text >= 2.8) {
                        $('#gpa_ans').removeClass('text-danger');
                        $('#gpa_ans').addClass('text-success');
                        $('#gpa_ans').html('Your Grade is B+ <br>Very Good Result <br>Your Percentage is ' + percentage + '%');
                    } else if (gpa_text < 2.8 && gpa_text >= 2.4) {
                        $('#gpa_ans').removeClass('text-danger');
                        $('#gpa_ans').addClass('text-success');
                        $('#gpa_ans').html('Your Grade is B <br>Good Result <br>Your Percentage is ' + percentage + '%');
                    } else if (gpa_text < 2.4 && gpa_text >= 2.0) {
                        $('#gpa_ans').removeClass('text-danger');
                        $('#gpa_ans').addClass('text-success');
                        $('#gpa_ans').html('Your Grade is C+ <br>Satisfactory Result <br>Your Percentage is ' + percentage + '%');
                    } else if (gpa_text < 2.0 && gpa_text >= 1.6) {
                        $('#gpa_ans').removeClass('text-danger');
                        $('#gpa_ans').addClass('text-success');
                        $('#gpa_ans').html('Your Grade is C <br>Acceptable Result <br>Your Percentage is ' + percentage + '%');
                    } else if (gpa_text < 1.6 && gpa_text >= 1.2) {
                        $('#gpa_ans').removeClass('text-danger');
                        $('#gpa_ans').addClass('text-success');
                        $('#gpa_ans').html('Your Grade is D+ <br>Partially Acceptable Result <br>Your Percentage is ' + percentage + '%');
                    } else if (gpa_text < 1.2 && gpa_text >= 0.8) {
                        $('#gpa_ans').removeClass('text-danger');
                        $('#gpa_ans').addClass('text-success');
                        $('#gpa_ans').html('Your Grade is D <br>Insufficient Result <br>Your Percentage is ' + percentage + '%');
                    } else {
                        $('#gpa_ans').removeClass('text-danger');
                        $('#gpa_ans').addClass('text-success');
                        $('#gpa_ans').html('Your Grade is E <br>Very Insufficient Result <br>Your Percentage is ' + percentage + '%');
                    }
                } else {
                    $('#gpa_ans').removeClass('text-success');
                    $('#gpa_ans').addClass('text-danger');
                    $('#gpa_ans').text('The range of GPA for students is 0 to 4, so please, covert your GPA within the range, i.e 0 to 4');
                }
            } else {
                $('#gpa_ans').addClass('text-danger');
                $('#gpa_ans').text('GPA Field is Empty');
            } 
        }
        
        $('#gpa_convert_btn').on('click', convertGPA);

        $('#gpa_text').on('keypress',function(e){
            if(e.which ===13 || e.key === 'Enter'){
                e.preventDefault();
                convertGPA();
            }
        });
    });
</script>
@endpush