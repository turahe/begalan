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

<!-- style css -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}">

    <!-- modernizr css -->
    <script src="{{asset('assets/js/vendor/modernizr-2.8.3.min.js')}}"></script>


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
                                    {!! $auth_user->get_photo !!}
                                </span>
                            </a>
                            <div class="profile-dropdown-menu pt-0">

                                <div class="profile-dropdown-userinfo bg-light p-3">
                                    <p class="m-0">{{ $auth_user->name }}</p>
                                    <small>{{$auth_user->email}}</small>
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
