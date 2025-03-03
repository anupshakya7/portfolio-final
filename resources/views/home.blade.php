@extends('layout.web')
@section('content')
<section id="profile">
    <div class="section__pic-container">
        <img src="{{asset('/assets/images/profile-pic.png')}}" alt="Anup Shakya Profile Pic">
    </div>
    <div class="section__text">
        <p class="section__text__p1">Hello, I'm</p>
        <h1>{{setting('site.owner') ?? ''}}</h1>
        <p class="section__text__p2"><span class="input"></span></p>
        <div class="btn-container">

            @if(setting('site.resume'))
            @php
                $resume = json_decode(setting('site.resume'))[0]->download_link;
            @endphp
            
            <button class="btn btn-color-2" onclick="window.open('{{asset('storage/'.$resume)}}')">
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
                <img src="{{asset('/assets/images/facebook.png')}}" alt="facebook" class="icon" onclick="window.open('{{setting('site.facebook')}}','_blank')">
            @endif
            <!-- Facebook -->

            <!-- Instagram -->
            @if(setting('site.instagram'))
                <img src="{{asset('/assets/images/instagram.png')}}" alt="instagram" class="icon" onclick="window.open('{{setting('site.instagram')}}','_blank')">
            @endif
            <!-- Instagram -->
            
            <!-- LinkedIn -->
            @if(setting('site.linkedin'))
                <img src="{{asset('/assets/images/linkedin.png')}}" alt="linkedin" class="icon" onclick="window.open('{{setting('site.linkedin')}}','_blank')">
            @endif
            <!-- LinkedIn -->

            <!-- Github -->
            @if(setting('site.github'))
                <img src="{{asset('/assets/images/github.png')}}" alt="github" class="icon" onclick="window.open('{{setting('site.github')}}','_blank')">
            @endif
            <!-- Github -->
            
            <!-- Youtube -->
            @if(setting('site.youtube'))
                <img src="{{asset('/assets/images/youtube.png')}}" alt="youtube" class="icon" onclick="window.open('{{setting('site.youtube')}}','_blank')">
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
            <img src="{{asset('/assets/images/about-pic.png')}}" alt="Profile Pic" class="about-pic">
        </div>
        <div class="about-details-container">
            <div class="about-containers">
                <div class="details-container">
                    <img src="{{asset('/assets/images/experience.png')}}" alt="Experience Icon" class="icon"/>
                    <h3>Experience</h3>
                    <p>3+ years <br/> Full Stack Development</p>
                </div>
                <div class="details-container">
                    <img src="{{asset('/assets/images/education.png')}}" alt="Education Icon" class="icon"/>
                    <h3>Education</h3>
                    <p>B.Sc. Bachelors Degree<br/></p>
                </div>
            </div>
            <div class="text-container">
                <p>I’m a Full Stack Developer with expertise in PHP, JavaScript, Laravel, Vue.js, React.js, Node.js, MySQL, MongoDB, and WordPress (including Voyager). I specialize in building responsive, dynamic web applications and working with CSS frameworks like Bootstrap and Tailwind. With solid experience in Git for version control, I’m committed to delivering efficient, scalable solutions.</p>
            </div>
        </div>
    </div>
    <img src="{{asset('/assets/images/arrow.png')}}" alt="Arrow Icon" class="icon arrow" onclick="location.href = './#experience'">
</section>
<section id="experience">
    <p class="section__text__p1">Explore My</p>
    <h1 class="title">Experience</h1>
    <div class="experience-details-container">
        <div class="about-containers">
            <div class="details-container">
                <h2 class="experience-sub-title">Frontend Development</h2>
                <div class="article-container">
                    <article>
                        <img src="{{asset('/assets/images/checkmark.png')}}" alt="Experience Icon" class="icon"/>
                        <div>
                            <h3>HTML</h3>
                            <p>Experienced</p>
                        </div>
                    </article>
                    <article>
                        <img src="{{asset('/assets/images/checkmark.png')}}" alt="Experience Icon" class="icon"/>
                        <div>
                            <h3>CSS</h3>
                            <p>Experienced</p>
                        </div>
                    </article>
                    <article>
                        <img src="{{asset('/assets/images/checkmark.png')}}" alt="Experience Icon" class="icon"/>
                        <div>
                            <h3>Javascript</h3>
                            <p>Intermediate</p>
                        </div>
                    </article>
                    <article>
                        <img src="{{asset('/assets/images/checkmark.png')}}" alt="Experience Icon" class="icon"/>
                        <div>
                            <h3>Bootstrap</h3>
                            <p>Experienced</p>
                        </div>
                    </article>
                    <article>
                        <img src="{{asset('/assets/images/checkmark.png')}}" alt="Experience Icon" class="icon"/>
                        <div>
                            <h3>Vue JS</h3>
                            <p>Intermediate</p>
                        </div>
                    </article>
                    <article>
                        <img src="{{asset('/assets/images/checkmark.png')}}" alt="Experience Icon" class="icon"/>
                        <div>
                            <h3>React JS</h3>
                            <p>Intermediate</p>
                        </div>
                    </article>
                    <article>
                        <img src="{{asset('/assets/images/checkmark.png')}}" alt="Experience Icon" class="icon"/>
                        <div>
                            <h3>Tailwind</h3>
                            <p>Basic</p>
                        </div>
                    </article>
                </div>
            </div>
            <div class="details-container">
                <h2 class="experience-sub-title">Backend Development</h2>
                <div class="article-container">
                    <article>
                        <img src="{{asset('/assets/images/checkmark.png')}}" alt="Experience Icon" class="icon"/>
                        <div>
                            <h3>Laravel</h3>
                            <p>Experienced</p>
                        </div>
                    </article>
                    <article>
                        <img src="{{asset('/assets/images/checkmark.png')}}" alt="Experience Icon" class="icon"/>
                        <div>
                            <h3>Node JS</h3>
                            <p>Intermediate</p>
                        </div>
                    </article>
                    <article>
                        <img src="{{asset('/assets/images/checkmark.png')}}" alt="Experience Icon" class="icon"/>
                        <div>
                            <h3>Express JS</h3>
                            <p>Intermediate</p>
                        </div>
                    </article>
                    <article>
                        <img src="{{asset('/assets/images/checkmark.png')}}" alt="Experience Icon" class="icon"/>
                        <div>
                            <h3>MySQL</h3>
                            <p>Experienced</p>
                        </div>
                    </article>
                    <article>
                        <img src="{{asset('/assets/images/checkmark.png')}}" alt="Experience Icon" class="icon"/>
                        <div>
                            <h3>Git</h3>
                            <p>Experienced</p>
                        </div>
                    </article>
                    <article>
                        <img src="{{asset('/assets/images/checkmark.png')}}" alt="Experience Icon" class="icon"/>
                        <div>
                            <h3>Mongo DB</h3>
                            <p>Intermediate</p>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </div>
    <img src="{{asset('/assets/images/arrow.png')}}" alt="Arrow Icon" class="icon arrow" onclick="location.href = './#projects'">
</section>
<section id="projects">
    <p class="section__text__p1">Browser My Recent</p>
    <h1 class="title">Projects</h1>
    <div class="experience-details-container">
        <div class="about-containers">
            <div class="details-container color-container">
                <div class="article-container">
                    <img src="{{asset('/assets/images/project-1.png')}}" alt="Project 1" class="project-img"/>
                </div>
                <h2 class="experience-sub-title project-title">Project One</h2>
                <div class="btn-container">
                    <button class="btn btn-color-2 project-btn" onclick="location.href='#'">
                        Github
                    </button>
                    <button class="btn btn-color-2 project-btn" onclick="location.href='#'">
                        Live Demo
                    </button>
                </div>
            </div>
            <div class="details-container color-container">
                <div class="article-container">
                    <img src="{{asset('/assets/images/project-2.png')}}" alt="Project 2" class="project-img"/>
                </div>
                <h2 class="experience-sub-title project-title">Project Two</h2>
                <div class="btn-container">
                    <button class="btn btn-color-2 project-btn" onclick="location.href='#'">
                        Github
                    </button>
                    <button class="btn btn-color-2 project-btn" onclick="location.href='#'">
                        Live Demo
                    </button>
                </div>
            </div>
            <div class="details-container color-container">
                <div class="article-container">
                    <img src="{{asset('/assets/images/project-3.png')}}" alt="Project 3" class="project-img"/>
                </div>
                <h2 class="experience-sub-title project-title">Project Three</h2>
                <div class="btn-container">
                    <button class="btn btn-color-2 project-btn" onclick="location.href='#'">
                        Github
                    </button>
                    <button class="btn btn-color-2 project-btn" onclick="location.href='#'">
                        Live Demo
                    </button>
                </div>
            </div>
        </div>
    </div>
    <img src="{{asset('/assets/images/arrow.png')}}" alt="Arrow Icon" class="icon arrow" onclick="location.href = './#contact'">
</section>
<section id="contact">
    <p class="section__text__p1">Get in Touch</p>
    <h1 class="title">Contact Me</h1>
    <div class="contact-info-upper-container">
        @if(setting('site.email'))
        <div class="contact-info-container">
            <img src="{{asset('/assets/images/email.png')}}" alt="Email Icon" class="icon contact-icon email-icon"/>
            <p><a href="mailto:{{setting('site.email')}}">{{setting('site.email')}}</a></p>
        </div>
        @endif
        @if(setting('site.linkedin'))
        <div class="contact-info-container">
            <img src="{{asset('/assets/images/linkedin.png')}}" alt="LinkedIn Icon" class="icon contact-icon"/>
            <p><a href="{{setting('site.linkedin')}}" target="_blank">LinkedIn</a></p>
        </div>
        @endif
    </div>
</section>
@endsection