@extends('voyager::master')
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
<link rel="stylesheet" href="{{ asset('assets/admin/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/css/mediaquery.css') }}">

@stop
@section('page_title', 'Portfolio Management')

@section('content')
    <div class="main_container">
        <header>
            <div class="tab_container">
                <ul>
                    <li class="active" id="about_tabBtn">About Me</li>
                    <li id="experience_tabBtn">Experience</li>
                    <li id="projects_tabBtn">Projects</li>
                </ul>
            </div>
        </header>
        <div class="tab_content">
            {{-- About Section --}}
            <section class="main_section" id="about_section">
                <h3 class="section_title_portfolio">About Me</h3>
                <div class="row">
                    <form action="{{route('portfolio.about.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card content_box">
                            <div class="about_me_top_section">
                                <div class="col-md-9">
                                    <div class="about_me_content_section">
                                        <div class="input_fields">
                                            <label for="about_bio">Description<span class="mandatory">*</span></label>
                                            <textarea name="description" placeholder="Please provide a brief introduction about yourself. Include your professional background, expertise, and any relevant details you'd like to share..." id="about_bio">{!! setting('site.about_description') !!}</textarea>
                                            @error('description')
                                                <span class="error_message">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="about_me_pic_section">
                                        <div class="about_me_pic">
                                            <span class="about_me_pic_close">
                                                <i class="fa-solid fa-xmark"></i>
                                            </span>
                                            @php
                                                $about_pic = !empty(setting('site.about_pic')) ?  Voyager::image(setting('site.about_pic')) : asset('assets/images/default_user.jpg');
                                            @endphp
                                            <img src="{{ $about_pic }}" alt="About Me Pic" id="about_me_image">
                                        </div>
                                        <div class="about_me_inputs">
                                            <label for="about_pic">Profile</label>
                                            <input type="file" name="about_pic" id="about_pic"/>
                                            @error('about_pic')
                                             <span class="error_message">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
        
                            <div class="col-md-9">
    
                                <div class="about_education_heading">
                                    <h4 class="section_subtitle_portfolio">Education</h4>
                                    <button type="button" class="section_primary_btn" id="add_education_btn"><i class="fa-solid fa-plus"></i></button>
                                </div>
                            
                                <div class="about_education_section">
                                    <div class="about_education_list">
                                        @if(count($educations)>0)
                                        @foreach($educations as $education)
                                        <div class="about_education_item card">
                                            <label for="degree">Degree Earned: <span class="mandatory">*</span></label>
                                            <input type="text" name="degree[]" value="{{$education->degree}}" id="degree" placeholder="Enter Degree">
                                            <label for="gpa">GPA: <span class="mandatory">*</span></label>
                                            <input type="text" name="gpa[]" value="{{$education->gpa}}" id="gpa" placeholder="Enter GPA">
                                            <button type="button" class="section_danger_btn remove_education_btn"><i class="fa-solid fa-minus"></i></button>
                    
                                        </div>
                                        @endforeach
                                        @else
                                        <div class="about_education_item card">
                                            <label for="degree">Degree Earned: <span class="mandatory">*</span></label>
                                            <input type="text" name="degree[]" id="degree" placeholder="Enter Degree">
                                            <label for="gpa">GPA: <span class="mandatory">*</span></label>
                                            <input type="text" name="gpa[]" id="gpa" placeholder="Enter GPA">
                                            <button type="button" class="section_danger_btn remove_education_btn"><i class="fa-solid fa-minus"></i></button>
                    
                                        </div>
                                        @endif
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="section_footer">
                                <button type="submit" class="section_primary_btn">Submit About Yourself</button>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
            {{-- About Section --}}

            {{-- Experience Section --}}
            <section class="main_section" id="experience_section">
                <h3 class="section_title_portfolio">Experience</h3>
                <div class="row">
                    <form action="{{route('portfolio.experience.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card content_box">
        
                            <div class="col-md-12">
    
                                <div class="about_education_heading experience_heading">
                                    {{-- <h4 class="section_subtitle_portfolio">Education</h4> --}}
                                    <button type="button" class="section_primary_btn experience_primary_btn" id="add_experience_btn"><i class="fa-solid fa-plus"></i></button>
                                </div>
                            
                                <div class="about_education_section">
                                    <div class="experience_education_list">
                                        @if(count($experiences)>0)
                                        @foreach($experiences as $experience)
                                        <div class="experience_education_item card">
                                            <label for="skills">Skills: <span class="mandatory">*</span></label>
                                            <input type="text" name="skills[]" id="skills" value="{{$experience->skills}}" placeholder="Enter Skills">
                                            <label for="gpa">Category: <span class="mandatory">*</span></label>
                                            <select name="category[]" class="" id="category">
                                                <option value="">Select Category</option>
                                                @foreach($experienceCategories as $experienceCategory)
                                                <option value="{{$experienceCategory->id}}" {{$experience->category_id == $experienceCategory->id ? 'selected':''}}>{{$experienceCategory->title}}</option>
                                                @endforeach
                                            </select>
                                            <label for="gpa">Level: <span class="mandatory">*</span></label>
                                            <select name="level[]" class="" id="level">
                                                <option value="">Select Level</option>
                                                <option value="Beginner" {{$experience->level == "Beginner" ? 'selected':''}}>Beginner</option>
                                                <option value="Intermediate" {{$experience->level == "Intermediate" ? 'selected':''}}>Intermediate</option>
                                                <option value="Proficient" {{$experience->level == "Proficient" ? 'selected':''}}>Proficient</option>
                                                <option value="Expert" {{$experience->level == "Expert" ? 'selected':''}}>Expert</option>
                                            </select>
                                            <button type="button" class="section_danger_btn remove_experience_btn"><i class="fa-solid fa-minus"></i></button>
                    
                                        </div>
                                        @endforeach
                                        @else
                                        <div class="experience_education_item card">
                                            <label for="skills">Skills: <span class="mandatory">*</span></label>
                                            <input type="text" name="skills[]" id="skills" placeholder="Enter Skills">
                                            <label for="gpa">Category: <span class="mandatory">*</span></label>
                                            <select name="category[]" class="" id="category">
                                                <option value="">Select Category</option>
                                                @foreach($experienceCategories as $experienceCategory)
                                                <option value="{{$experienceCategory->id}}">{{$experienceCategory->title}}</option>
                                                @endforeach
                                            </select>
                                            <label for="gpa">Level: <span class="mandatory">*</span></label>
                                            <select name="level[]" class="" id="level">
                                                <option value="">Select Level</option>
                                                <option value="Beginner">Beginner</option>
                                                <option value="Intermediate">Intermediate</option>
                                                <option value="Proficient">Proficient</option>
                                                <option value="Expert">Expert</option>
                                            </select>
                                            <button type="button" class="section_danger_btn remove_experience_btn"><i class="fa-solid fa-minus"></i></button>
                    
                                        </div>
                                        @endif
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="section_footer experience_footer">
                                <button type="submit" class="section_primary_btn">Submit Your Experience</button>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
            {{-- Experience Section --}}

            {{-- Projects Section --}}
            <section class="main_section" id="projects_section">
                <h3 class="section_title_portfolio">Project</h3>
                <div class="row">
                    <form action="{{route('portfolio.about.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card content_box">
                            <div class="about_me_top_section">
                                <div class="col-md-9">
                                    <div class="about_me_content_section">
                                        <div class="input_fields">
                                            <label for="about_bio">Description<span class="mandatory">*</span></label>
                                            <textarea name="description" placeholder="Please provide a brief introduction about yourself. Include your professional background, expertise, and any relevant details you'd like to share..." id="about_bio">{!! setting('site.about_description') !!}</textarea>
                                            @error('description')
                                                <span class="error_message">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="about_me_pic_section">
                                        <div class="about_me_pic">
                                            <span class="about_me_pic_close">
                                                <i class="fa-solid fa-xmark"></i>
                                            </span>
                                            @php
                                                $about_pic = !empty(setting('site.about_pic')) ?  Voyager::image(setting('site.about_pic')) : asset('assets/images/default_user.jpg');
                                            @endphp
                                            <img src="{{ $about_pic }}" alt="About Me Pic" id="about_me_image">
                                        </div>
                                        <div class="about_me_inputs">
                                            <label for="about_pic">Profile</label>
                                            <input type="file" name="about_pic" id="about_pic"/>
                                            @error('about_pic')
                                             <span class="error_message">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
        
                            <div class="col-md-9">
    
                                <div class="about_education_heading">
                                    <h4 class="section_subtitle_portfolio">Education</h4>
                                    <button type="button" class="section_primary_btn" id="add_education_btn"><i class="fa-solid fa-plus"></i></button>
                                </div>
                            
                                <div class="about_education_section">
                                    <div class="about_education_list">
                                        @if(count($educations)>0)
                                        @foreach($educations as $education)
                                        <div class="about_education_item card">
                                            <label for="degree">Degree Earned: <span class="mandatory">*</span></label>
                                            <input type="text" name="degree[]" value="{{$education->degree}}" id="degree">
                                            <label for="gpa">GPA: <span class="mandatory">*</span></label>
                                            <input type="text" name="gpa[]" value="{{$education->gpa}}" id="gpa">
                                            <button type="button" class="section_danger_btn remove_education_btn"><i class="fa-solid fa-minus"></i></button>
                    
                                        </div>
                                        @endforeach
                                        @else
                                        <div class="about_education_item card">
                                            <label for="degree">Degree Earned: <span class="mandatory">*</span></label>
                                            <input type="text" name="degree[]" id="degree">
                                            <label for="gpa">GPA: <span class="mandatory">*</span></label>
                                            <input type="text" name="gpa[]" id="gpa">
                                            <button type="button" class="section_danger_btn remove_education_btn"><i class="fa-solid fa-minus"></i></button>
                    
                                        </div>
                                        @endif
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="section_footer">
                                <button type="submit" class="section_primary_btn">Submit About Yourself</button>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
            {{-- Projects Section --}}
        </div>

       
    </div>
@stop
@section('javascript')
<script>
    $(document).ready(function(){
        //Session Exist
        @if(session()->has('success'))
            toastr.success('{{session('success')}}')
        @endif

        @if(session()->has('error'))
            toastr.error('{{session('error')}}')
        @endif

        //Tab Change
        //Add Active Class
        $('.tab_container ul li').click(function(){
            $('.tab_container ul li').removeClass('active');
            $(this).addClass('active');
        });

        // Hide Section When First Open Page
        $('#experience_section').hide();
        $('#projects_section').hide();

        $('#about_tabBtn').click(function(){
            $('#experience_section').hide();
            $('#projects_section').hide();
            $('#about_section').show();
        });
        $('#experience_tabBtn').click(function(){
            $('#about_section').hide();
            $('#projects_section').hide();
            $('#experience_section').show();
        });
        $('#projects_tabBtn').click(function(){
            $('#about_section').hide();
            $('#experience_section').hide();
            $('#projects_section').show();
        });

        //Add Image When User Select
        $('#about_pic').on('change',function(){
            var reader = new FileReader();

            reader.onload = function(e){
                $('#about_me_image').attr('src',e.target.result);
            };

            reader.readAsDataURL(this.files[0]);
        });

        //Remove Image when User Click Close Icon
        $('.about_me_pic_close').on('click',function(){
            $('#about_me_image').attr('src','{{asset('assets/images/default_user.jpg')}}');
            $('#about_pic').val('');
        })

        //Add New Field For Education
        $('#add_education_btn').click(function(){
            $('.about_education_list').append(`<div class="about_education_item card">
                                    <label for="degree">Degree Earned: <span class="mandatory">*</span></label>
                                    <input type="text" name="degree[]" id="degree" placeholder="Enter Degree">
                                    <label for="gpa">GPA: <span class="mandatory">*</span></label>
                                    <input type="text" name="gpa[]" id="gpa" placeholder="Enter GPA">
                                    <button type="button" class="section_danger_btn remove_education_btn"><i class="fa-solid fa-minus"></i></button>
                                </div>`);
        });

        //Remove Field For Education
        $(document).on('click','.remove_education_btn',function(){
            console.log($('.about_education_list .about_education_item').length);
            if($('.about_education_list .about_education_item').length > 1){
                $(this).closest('.about_education_item').remove();
            }else{
                toastr.error('Please add at least one entry to proceed.');
            }
        });

        //Add New Field For Experience
        $('#add_experience_btn').click(function(){
            $('.experience_education_list').append(`<div class="experience_education_item card">
                                            <label for="skills">Skills: <span class="mandatory">*</span></label>
                                            <input type="text" name="skills[]" id="skills" placeholder="Enter Skills">
                                            <label for="gpa">Category: <span class="mandatory">*</span></label>
                                            <select name="category[]" class="" id="category">
                                                <option value="">Select Category</option>
                                                @foreach($experienceCategories as $experienceCategory)
                                                <option value="{{$experienceCategory->id}}">{{$experienceCategory->title}}</option>
                                                @endforeach
                                            </select>
                                            <label for="gpa">Level: <span class="mandatory">*</span></label>
                                            <select name="level[]" class="" id="level">
                                                <option value="">Select Level</option>
                                                <option value="Beginner">Beginner</option>
                                                <option value="Intermediate">Intermediate</option>
                                                <option value="Proficient">Proficient</option>
                                                <option value="Expert">Expert</option>
                                            </select>
                                            <button type="button" class="section_danger_btn remove_experience_btn"><i class="fa-solid fa-minus"></i></button>
                    
                                        </div>`);
            $('.select2').select2();
        });


        //Remove Field For Education
        $(document).on('click','.remove_experience_btn',function(){
            console.log($('.experience_education_list .experience_education_item').length);
            if($('.experience_education_list .experience_education_item').length > 1){
                $(this).closest('.experience_education_item').remove();
            }else{
                toastr.error('Please add at least one entry to proceed.');
            }
        });

    });
</script>
@stop

