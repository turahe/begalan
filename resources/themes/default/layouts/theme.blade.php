
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ config('global.enable_rtl')? 'rtl' : 'auto'}}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('favicon.png')}}"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>  {{ $title ?? '' }} | {{ config('app.name') }} </title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    @yield('page-css')

    <link rel="stylesheet" href="{{ asset('css/app.css')}}">


    <script type="text/javascript">
        /* <![CDATA[ */
        window.pageData = @json(pageJsonData());
        /* ]]> */
    </script>
    {{--    @routes--}}
</head>
<body class="{{ config('global.enable_rtl')? 'rtl' : ''}}">

<div class="main-navbar-wrap">


    <nav class="navbar navbar-expand-lg navbar-light bg-light">

        <div class="container">
            <a class="navbar-brand site-main-logo" href="{{route('home')}}">

                <img src="{{asset('assets/images/logo.png')}}" alt="{{ config('app.name')}}"/>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainNavbarContent"
                    aria-controls="mainNavbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNavbarContent">
                <ul class="navbar-nav categories-nav-item-wrapper mt-2 mt-lg-0">
                    <li class="nav-item nav-categories-item">
                        <a class="nav-link browse-categories-nav-link" href="{{route('categories')}}">
                            <i class="las la-th-large"></i>
                            @lang('front_end.categories')
                        </a>

                        <div class="categories-menu">
                            <ul class="categories-ul-first">
                                <li>
                                    <a href="{{route('categories')}}">
                                        <i class="las la-th-list"></i> @lang('front_end.all_categories')
                                    </a>
                                </li>
                                @foreach($categories as $category)
                                    <li>
                                        <a href="{{ $category->url }}">
                                            <i class="las {{$category->icon_class}}"></i> {{$category->name}}

                                            @if($category->sub_categories->count())
                                                <i class="las la-angle-right"></i>
                                            @endif
                                        </a>
                                        @if($category->sub_categories->count())
                                            <ul class="level-sub">
                                                @foreach($category->sub_categories as $subCategory)
                                                    <li>
                                                        <a href="{{ $subCategory->slug }}">{{$subCategory->name}}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                    </li>

                </ul>

                <div class="header-search-wrap my-2 my-lg-0  ml-2">
                    <form action="{{route('courses')}}" class="form-inline " method="get">
                        <input class="form-control" type="search" name="q" value="{{request('q')}}"
                               placeholder="Search">
                        <button class="btn my-2 my-sm-0 header-search-btn" type="submit"><i class="las la-search"></i>
                        </button>
                    </form>
                </div>

                <ul class="navbar-nav main-nav-auth-profile-wrap justify-content-end mt-2 mt-lg-0 flex-grow-1">

                    <li class="nav-item dropdown mini-cart-item">
                        @include('default.template-part.minicart')
                    </li>

                    @if (Auth::guest())
                        <li class="nav-item mr-2 ml-2">
                            <a class="nav-link btn btn-login-outline" href="{{route('login')}}">
                                <i class="las la-sign-in"></i>
                                @lang('login')
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn--pdefault.rimary" href="{{route('register')}}">
                                <i class="las la-user-plus"></i>
                                @lang('signup')
                            </a>
                        </li>
                    @else
                        <li class="nav-item dropdown mini-cart-item">
                            @include('default.template-part.notification')
                        </li>
                        <li class="nav-item main-nav-right-menu nav-item-user-profile">
                            <a class="nav-link profile-dropdown-toogle" href="javascript:;">
                                <span class="top-nav-user-name">
                                    {!! auth()->user()->get_photo !!}
                                </span>
                            </a>
                            <div class="profile-dropdown-menu pt-0">

                                <div class="profile-dropdown-userinfo bg-light p-3">
                                    <p class="m-0">{{ auth()->user()->name }}</p>
                                    <small>{{auth()->user()->email}}</small>
                                </div>

                                @include('theme::dashboard.sidebar-menu')
                            </div>
                        </li>
                    @endif

                </ul>

            </div>
        </div>

    </nav>

</div>

@yield('content')
<footer>

    <div class="footer-top py-5">

        <div class="container">
            <div class="row">

                <div class="col-md-3">
                    <div class="footer-widget-wrap">
                        <h4>About US</h4>
                        <p class="footer-about-us-desc">
                            WebAcademy is a LMS platform that connect Teachers with Students globally.
                            Teachers crate high quality course and present them in super easy way.
                        </p>
                        <p class="footer-social-icon-wrap">
                            <a href="#"><i class="las la-facebook"></i> </a>
                            <a href="#"><i class="las la-twitter"></i> </a>
                            <a href="#"><i class="las la-youtube"></i> </a>
                        </p>
                    </div>
                </div>


                <div class="col-md-3">
                    <div class="footer-widget-wrap contact-us-widget-wrap">
                        <h4>Contact</h4>
                        <p class="footer-address">
                            Jalan kesukesan menuju harapan np.29
                            Anggrek, Pekalongan 40236
                            Jawa Tengah - Indonesia
                        </p>

                        <p class="mb-0"> Tel.: (+62)-22-54480371 </p>
                        <p class="mb-0"> Fax: (+62)-22-54480371 </p>
                        <p class="mb-0"> hello@turahe.id </p>
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="footer-widget-wrap link-widget-wrap">

                        <ul class="footer-links">
                            <li><a href="{{route('home')}}">@lang('theme.home')</a></li>
                            <li><a href="{{route('dashboard')}}">@lang('theme.dashboard')</a></li>
                            <li><a href="{{route('courses')}}">@lang('theme.courses')</a></li>
                            <li><a href="{{route('blog')}}">@lang('theme.blog')</a></li>
                            <li><a href="{{route('post_proxy')}}">@lang('theme.about_us')</a></li>
                            <li><a href="{{route('register')}}">@lang('theme.signup')</a></li>
                            <li><a href="#">Contact Us</a></li>
                        </ul>

                    </div>
                </div>

            </div>
        </div>
    </div>


    <div class="footer-bottom py-5">

        <div class="container">

            <div class="row">
                <div class="col-md-12">
                    <div class="footer-bottom-contents-wrap d-flex">

                        <div class="footer-bottom-left d-flex">
                            <h5 class="text-warning">WebAcademy</h5>
                            <span class="ml-4">Copyright &copy; Turahe {{ date('Y') }} WebAcademy. All rights reserved.</span>
                        </div>

                        <div class="footer-bottom-right flex-grow-1 text-right">
                            <ul class="footer-bottom-right-links">
                                <li>
                                    <a href="{{route('post_proxy', get_option('terms_of_use_page'))}}">
                                        @lang('terms_of_use')
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('post_proxy', get_option('privacy_policy_page'))}}">
                                        @lang('privacy_policy') &amp; @lang('cookie_policy')
                                    </a>
                                </li>

                            </ul>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>


</footer>


<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    {{ csrf_field() }}
</form>

@if( ! auth()->check() && request()->path() != 'login')
    @include('default.template-part.login-modal-form')
@endif

<script src="{{ mix('js/app.js') }}"></script>
@yield('page-js')
<script src="{{ asset('assets/js/main.js')}}"></script>
</body>
</html>

