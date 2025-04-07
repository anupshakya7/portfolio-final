@extends('layout.web')
@section('content')
<section id="profile">
    <div class="section__pic-container">
        @if(setting('site.owner_pic'))
        <img src="{{Voyager::image(setting('site.owner_pic'))}}" alt="{{setting('site.owner_name') ?? ''}} Profile Pic">
        @endif
    </div>
    <div class="section__text">
        <p class="section__text__p1">Hello, I'm</p>
        <h1>{{setting('site.owner_name') ?? ''}}</h1>
        <p class="section__text__p2"><span class="input"></span></p>
        <div class="btn-container">
            @if(setting('site.resume'))
            @php
                $resume = str_replace('\\','/',json_decode(setting('site.resume'))[0]->download_link);
            @endphp
            
            <button class="btn btn-color-2" onclick="window.open('{{
            Voyager::image($resume)}}')">
                Download CV
            </button>
            @endif
            
            <button class="btn btn-color-1" onclick="location.href ='./#contact'">
                Contact Info
            </button>
        </div>
        <div id="socials-container">
            <!-- Facebook -->
            @if(setting('site.facebook'))
                <img src="{{asset('public/assets/images/facebook.png')}}" alt="facebook" class="icon" onclick="window.open('{{setting('site.facebook')}}','_blank')">
            @endif
            <!-- Facebook -->

            <!-- Instagram -->
            @if(setting('site.instagram'))
                <img src="{{asset('public/assets/images/instagram.png')}}" alt="instagram" class="icon" onclick="window.open('{{setting('site.instagram')}}','_blank')">
            @endif
            <!-- Instagram -->
            
            <!-- LinkedIn -->
            @if(setting('site.linkedin'))
                <img src="{{asset('public/assets/images/linkedin.png')}}" alt="linkedin" class="icon" onclick="window.open('{{setting('site.linkedin')}}','_blank')">
            @endif
            <!-- LinkedIn -->

            <!-- Github -->
            @if(setting('site.github'))
                <img src="{{asset('public/assets/images/github.png')}}" alt="github" class="icon" onclick="window.open('{{setting('site.github')}}','_blank')">
            @endif
            <!-- Github -->
            
            <!-- Youtube -->
            @if(setting('site.youtube'))
                <img src="{{asset('public/assets/images/youtube.png')}}" alt="youtube" class="icon" onclick="window.open('{{setting('site.youtube')}}','_blank')">
            @endif
            <!-- Youtube -->

        </div>
    </div>
</section>
<section id="about">
    <p class="section__text__p1">Get To Know More</p>
    <h1 class="title">About Me</h1>
    <div class="section-container">
        <div class="section__pic-container">
            @php
                if(setting('site.about_pic')){
                    $about_pic = Voyager::image(setting('site.about_pic'));
                }else{
                    $about_pic = asset('assets/images/default_user.jpg');
                }
            @endphp
            <img src="{{$about_pic}}" alt="Profile Pic" class="about-pic">
        </div>
        <div class="about-details-container">
            <div class="about-containers">
                <div class="details-container">
                    <img src="{{asset('public/assets/images/experience.png')}}" alt="Experience Icon" class="icon"/>
                    <h3>Experience</h3>
                    <p>3+ years <br/> Full Stack Development</p>
                </div>
                <div class="details-container">
                    <img src="{{asset('public/assets/images/education.png')}}" alt="Education Icon" class="icon"/>
                    <h3>Education</h3>
                    @if(count($educations) > 0)
                    @foreach($educations as $education)
                    <p>{{$education->degree}}<br/></p>
                    @endforeach
                    @endif
                </div>
            </div>
            <div class="text-container">
                @if(setting('site.about_description'))
                <p>{!! setting('site.about_description') !!}</p>
                @endif
            </div>
        </div>
    </div>
    <img src="{{asset('public/assets/images/arrow.png')}}" alt="Arrow Icon" class="icon arrow" onclick="location.href = './#experience'">
</section>
<section id="experience">
    <p class="section__text__p1">Explore My</p>
    <h1 class="title">Experience</h1>
    <div class="experience-details-container">
        <div class="about-containers">
            @if(count($experiences) > 0)
            @foreach($experiences as $experience)
            <div class="details-container">
                <h2 class="experience-sub-title">{{$experience->title}}</h2>
                <div class="article-container">
                    @foreach($experience->skills as $skill)
                    <article>
                        <img src="{{asset('public/assets/images/checkmark.png')}}" alt="{{$skill->skills}} Experience Icon" class="icon"/>
                        <div>
                            <h3>{{$skill->skills}}</h3>
                            <p>{{$skill->level}}</p>
                        </div>
                    </article>
                    @endforeach
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
    <img src="{{asset('public/assets/images/arrow.png')}}" alt="Arrow Icon" class="icon arrow" onclick="location.href = './#projects'">
</section>
<section id="projects">
    <p class="section__text__p1">Browser My Recent</p>
    <h1 class="title">Projects</h1>
    <div class="experience-details-container swiper-container">
        <div class="swiper-wrapper">
            @if(count($projects)>0)
            @foreach($projects as $key=>$project)
            @php
                $projectImg = $project->project_pic !== null ? Voyager::image($project->project_pic) : asset('/assets/images/project-1.png'); 
            @endphp
            <div class="swiper-slide">
                <div class="details-container color-container">
                    <div class="article-container">
                        <img src="{{$projectImg}}" alt="{{ $project->title }}" class="project-img"/>
                    </div>
                    <h2 class="experience-sub-title project-title">{{ $project->title }}</h2>
                    <div class="btn-container">
                        @if($project->github)
                        <button class="btn btn-color-2 project-btn" onclick="window.open('{{ $project->github }}','_blank');">
                            Github
                        </button>
                        @endif
                        @if($project->live)
                        <button class="btn btn-color-2 project-btn" onclick="window.open('{{ $project->live }}','_blank');">
                            Live Demo
                        </button>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
            @endif
        </div>
         <!--Navigation-->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        
        <!--Pagination-->
        <div class="swiper-pagination"></div>
        
       
    </div>
    <img src="{{asset('public/assets/images/arrow.png')}}" alt="Arrow Icon" class="icon arrow" onclick="location.href = './#contact'">
</section>
<section id="contact">
    <p class="section__text__p1">Get in Touch</p>
    <h1 class="title">Contact Me</h1>
    <div class="contact-info-upper-container">
        @if(setting('site.email'))
        <div class="contact-info-container">
            <img src="{{asset('public/assets/images/email.png')}}" alt="Email Icon" class="icon contact-icon email-icon"/>
            <p><a href="mailto:{{setting('site.email')}}">{{setting('site.email')}}</a></p>
        </div>
        @endif
        @if(setting('site.linkedin'))
        <div class="contact-info-container">
            <img src="{{asset('public/assets/images/linkedin.png')}}" alt="LinkedIn Icon" class="icon contact-icon"/>
            <p><a href="{{setting('site.linkedin')}}" target="_blank">LinkedIn</a></p>
        </div>
        @endif
    </div>
</section>
@endsection