@extends('voyager::master')
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
<link rel="stylesheet" href="{{ asset('assets/admin/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/css/mediaquery.css') }}">

@endsection
@section('page_title', 'Portfolio Management')

@section('content')
    <div class="main_container">
        <section class="main_section">
            <h3 class="section_title_portfolio">About Me</h3>
            <div class="row">
                <div class="card content_box">
                    <div class="col-md-9">
                     <div class="about_me_content_section">
                        <div class="input_fields">
                            <label for="about_bio">Description</label>
                            <textarea name="description" placeholder="Please provide a brief introduction about yourself. Include your professional background, expertise, and any relevant details you'd like to share..." id="about_bio"></textarea>
                        </div>
                     </div>
                    </div>
                    <div class="col-md-3">
                        <div class="about_me_pic_section">
                            <div class="about_me_pic">
                                <span class="about_me_pic_close">
                                    <i class="fa-solid fa-xmark"></i>
                                </span>
                                <img src="{{ asset('assets/images/profile-pic.png') }}" alt="About Me Pic" id="about_me_pic">
                            </div>
                            <div class="about_me_inputs">
                                <label for="about_pic">Profile</label>
                                <input type="file" name="about_pic" id="about_pic"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="about_education_heading">
                            <h4 class="section_subtitle_portfolio">Education</h4>
                            <button class="section_primary_btn"><i class="fa-solid fa-plus"></i></button>
                        </div>
                       
                        <div class="about_education_section">
                            <div class="about_education_list">
                                <div class="about_education_item card">
                                    <label for="degree">Degree Earned: </label>
                                    <input type="text" name="degree" id="degree">
                                    <label for="gpa">GPA: </label>
                                    <input type="text" name="gpa" id="gpa">
                                    <button class="section_danger_btn"><i class="fa-solid fa-minus"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
       
    </div>
@stop

