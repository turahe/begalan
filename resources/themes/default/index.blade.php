@extends('theme::layouts.theme', [
    'title' => 'Home page'
])


@section('content')

    <div class="hero-banner py-3">

        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-6">

                    <div class="hero-left-wrap">
                        <h1 class="hero-title mb-4">@lang('theme.hero_title')</h1>
                        <p class="hero-subtitle  mb-4">
                            @lang('theme.hero_subtitle')
                        </p>
                        <a href="{{route('categories')}}" class="btn btn-theme-primary btn-lg">Browse Course</a>
                    </div>

                </div>


                <div class="col-md-12 col-lg-6 hero-right-col">
                    <div class="hero-right-wrap">
                        <img src="{{ asset('images/hero-image.png')}}" class="img-fluid"/>
                    </div>
                </div>
            </div>
        </div>


    </div>


    <div class="home-section-wrap home-info-box-wrapper py-5">
        <div class="container">
            <div class="row">

                <div class="col-md-3">
                    <div class="home-info-box">
                        <img src="{{ asset('images/skills.svg')}}">
                        <h3 class="info-box-title">Learn the latest skills</h3>
                        <p class="info-box-desc">like business analytics, graphic design, Python, and more</p>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="home-info-box">
                        <img src="{{ asset('images/career-goal.svg')}}">
                        <h3 class="info-box-title">Get ready for a career</h3>
                        <p class="info-box-desc">in high-demand fields like IT, AI and cloud engineering</p>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="home-info-box">
                        <img src="{{ asset('images/instructions.svg')}}">
                        <h3 class="info-box-title">Expert instruction</h3>
                        <p class="info-box-desc">Every course designed by expert instructor</p>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="home-info-box">
                        <img src="{{ asset('images/cartificate.svg')}}">
                        <h3 class="info-box-title">Earn a certificate</h3>
                        <p class="info-box-desc">Get certified upon completing a course</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @if($featured_courses->count())
        <div class="home-section-wrap home-featured-courses-wrapper py-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-header-wrap">
                            <h3 class="section-title">
                                @lang('theme.featured_courses')

                                <a href="{{route('featured_courses')}}" class="btn btn-link float-right">
                                    <i
                                            class="las la-bookmark"></i> @lang('theme.all_featured_courses')</a>
                            </h3>

                            <p class="section-subtitle">@lang('theme.featured_courses_desc')}}</p>
                        </div>
                    </div>
                </div>
                <div class="popular-courses-cards-wrap mt-3">
                    <div class="row">
                        @foreach($featured_courses as $course)
                            {!! course_card($course, 'col-md-4') !!}
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif


    <div class="mid-callto-action-wrap text-white text-center py-5">
        <div class="container py-3">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mb-3">Find the perfect course for you</h2>
                    <h4 class="mb-3 mid-callto-action-subtitle">Choose from over 100 online video courses <br/> with new
                        additions published every day</h4>

                    <a href="{{route('courses')}}" class="btn btn-warning btn-lg">Find new courses</a>
                </div>
            </div>
        </div>
    </div>

    @if($popular_courses->count())
        <div class="home-section-wrap home-fatured-courses-wrapper py-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-header-wrap">
                            <h3 class="section-title">@lang('theme.popular_courses')

                                <a href="{{route('popular_courses')}}" class="btn btn-link float-right">
                                    <i class="las la-bolt"></i>
                                    @lang('theme.all_popular_courses')
                                </a>
                            </h3>
                            <p class="section-subtitle">
                                @lang('theme.popular_courses_desc')
                            </p>
                        </div>
                    </div>
                </div>
                <div class="popular-courses-cards-wrap mt-3">
                    <div class="row">
                        @foreach($featured_courses as $course)

                            @include('theme::template-part.course-loop', ['course' => $course])
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif


    @if($new_courses->count())
        <div class="home-section-wrap home-new-courses-wrapper py-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-header-wrap">
                            <h3 class="section-title">@lang('theme.new_arrival')

                                <a href="{{route('courses')}}" class="btn btn-link float-right">
                                    <i
                                            class="las la-list"></i>
                                    @lang('theme.all_courses')
                                </a>
                            </h3>
                            <p class="section-subtitle">
                                @lang('theme.new_arrival_desc')
                            </p>
                        </div>
                    </div>
                </div>

                <div class="popular-courses-cards-wrap mt-3">
                    <div class="row">
                        @foreach($new_courses as $course)
                            @include('theme::template-part.course-loop', ['course' => $course])
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if($posts->count())
        <div class="home-section-wrap home-blog-section-wrapper py-5">

            <div class="container">

                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="section-header-wrap">
                            <h3 class="section-title">@lang('theme.latest_blog_text')</h3>
                            <p class="section-subtitle">@lang('theme.latest_blog_desc')</p>
                        </div>
                    </div>
                </div>


                <div class="row">
                    @foreach($posts as $post)
                        <div class="col-lg-4 mb-4">
                            <div class="home-blog-card">
                                <a href="{{$post->url}}">
                                    {{ $post->getFirstMedia() }}
                                </a>
                                <div class="excerpt px-4">
                                    <h2><a href="{{$post->url}}">{{$post->title}}</a></h2>
                                    <div class="post-meta d-flex justify-content-between">
                                    <span>
                                        <i class="las la-user"></i>
                                        <a href="{{route('profile', $post->user_id)}}">
                                            {{$post->author->name}}
                                        </a>
                                    </span>
                                        <span><i
                                                    class="las la-calendar"></i>&nbsp; {{$post->published_time}}</span>
                                    </div>
                                    <p class="mt-4">
                                        <a href="{{$post->url}}"><strong>READ MORE <i class="las la-arrow-right"></i>
                                            </strong></a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="btn-see-all-posts-wrapper pt-4">
                    <div class="row">
                        <div class="col-md-12 d-flex">
                            <a href="{{route('blog')}}" class="btn btn-lg btn-theme-primary ml-auto mr-auto">
                                <i class="las la-blog"></i> See All Posts
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    @endif

    <div class="home-section-wrap home-cta-wrapper py-5 ">

        <div class="home-partners-logo-section pb-5 mb-5 text-center">
            <div class="container">

                <h5 class="home-partners-title mb-5">Companies use WebAcademy to enrich their brand & business.</h5>

                <div class="home-partners-logo-wrap">
                    <div class="logo-item">
                        <a href=""><img src="{{ asset('images/adidas.png')}}" alt="adidas"/></a>
                    </div>
                    <div class="logo-item">
                        <a href=""><img src="{{ asset('images/disnep.png')}}" alt="images"/></a>
                    </div>
                    <div class="logo-item">
                        <a href=""><img src="{{ asset('images/intel.png')}}" alt="intel"/></a>
                    </div>
                    <div class="logo-item">
                        <a href=""><img src="{{ asset('images/penlaw.png')}}" alt="penlaw"/></a>
                    </div>
                    <div class="logo-item">
                        <a href=""><img src="{{ asset('images/shopify.png')}}" alt="shopify"/></a>
                    </div>
                </div>

            </div>
        </div>

        <div class="home-course-stats-wrap pb-5 mb-5 text-center">
            <div class="container">
                <div class="row">
                    <div class="col-md-3"><h3>580</h3> <h5>Active Courses</h5></div>
                    <div class="col-md-3"><h3>1200</h3> <h5>Hours Video</h5></div>
                    <div class="col-md-3"><h3>850</h3> <h5>Teachers</h5></div>
                    <div class="col-md-3"><h3>1800</h3> <h5>Students Learning</h5></div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-sm-6 home-cta-left-col">

                    <div class="home-cta-text-wrapper px-5 text-center">
                        <h4>Become an instructor</h4>
                        <p>Spread your knowledge to millions of students around the world through WebAcademy teaching
                            platform. You can teach any tech you love from heart.
                        </p>
                        <a href="{{route('create_course')}}" class="btn btn-theme-primary">Start Teaching Today</a>

                    </div>

                </div>

                <div class="col-sm-6">

                    <div class="home-cta-text-wrapper px-5 text-center">
                        <h4>Discover latest technology</h4>
                        <p>Earn new skills and enroll to the new courses. Continuous learning is only key to keep your
                            self up-to-date with modern technology.
                        </p>
                        <a href="{{route('courses')}}" class="btn btn-theme-primary">
                            @lang('theme.find_new_courses')
                        </a>
                    </div>

                </div>

            </div>
        </div>

    </div>

@endsection
