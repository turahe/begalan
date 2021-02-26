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

{{--<script src="{{ mix('js/manifest.js') }}"></script>--}}
{{--<script src="{{ mix('js/vendor.js') }}"></script>--}}
<script src="{{ mix('js/app.js') }}"></script>

<!-- jquery latest version -->
{{--<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>--}}
{{--<script src="{{asset('assets/js/vendor/jquery-1.12.0.min.js')}}"></script>--}}
<!-- bootstrap js -->
{{--<script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>--}}

@yield('page-js')

<!-- main js -->
<script src="{{ asset('assets/js/main.js')}}"></script>


</body>
</html>
