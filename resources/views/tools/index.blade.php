@extends('layout.web')
@section('title', 'GPA Calculator | Convert Grades to Percentage Instantly')
@section('description',
    'Convert GPA and grades to percentage instantly with our free GPA calculator. Accurate, fast and
    ideal for students, colleges and universities.')
    @push('css')
        <style>
            .blog-single-container {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
            }

            .blog_item {
                width: auto;
                margin:12px 12px;
                box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
            }

            section {
                padding-top: 10vh;
            }

            .btn {
                padding: 5px 8px;
            }

            .btn:hover {
                color: #fff;
            }

            /* .blog-single-container{
                                        display: flex;
                                        gap: 20px;
                                    } */

            .blog-single-container a:hover {
                color: #fff;
            }

            i {
                margin-right: 4px;
            }

            .article-container {
                text-align: none;
                justify-content: center;
            }

            .article-container img {
                width: 100px;
                height: 100px;
                filter: drop-shadow(rgba(0, 0, 0, 0.1) 0px 4px 12px);
            }

            .project-img {
                border-radius: 0px;
            }

            .blog-footer {
                justify-content: center;
            }

            @media(max-width: 999px) {
                .blog-single-container {
                    grid-template-columns: repeat(2, 1fr);
                }

                /* .blog-single-container {
                            flex-wrap: wrap;
                        } */
            }

            @media(max-width: 792px) {
                .blog-single-container {
                    display: flex;
                    flex-wrap: wrap;
                }

                .blog_item{
                    width: 100%;
                }

                /* .blog-single-container {
                    flex-direction: column;
                } */
            }
        </style>
    @endpush
@section('content')
    <!-- Breadcrumb -->
    @include('partials.breadcrumb', ['mainTitle' => 'Tools'])
    <section id="blog-list-section" data-aos="fade-left" data-aos-delay="200" data-aos-duration="1000">
        <div class="blog-single-container">
            @forelse($tools as $tool)
                <div class="details-container color-container equal-height blog_item">
                    <div class="article-container equal-height-item">
                        <img src="{{ set_storage_url($tool->icon) }}" alt="Tool Icon" class="project-img" />
                    </div>
                    <h2 class="blogs-sub-title project-title equal-height-title">{{ $tool->title }}</h2>
                    <div class="btn-container blog-footer">
                        <a href="{{ url('/tools/' . $tool->slug) }}" class="btn btn-color-2 project-btn">
                            <i class="fas fa-tools"></i>
                            View Tool
                        </a>
                    </div>
                </div>
            @empty
                <div>
                    <h4>No Tools Found</h4>
                    <p>Please check back later.</p>
                </div>
            @endforelse
        </div>
    </section>
@endsection
@push('script')
@endpush
