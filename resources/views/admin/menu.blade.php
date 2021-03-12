
<div class="navbar-default sidebar" role="navigation">
    <div id="adminmenuback"></div>
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li>
                <a href="{{route('admin.dashboard')}}">
                    <i class="las la-dashboard fa-fw"></i>
                    @lang('admin.admin_home')
                </a>
            </li>

            @php
                do_action('admin_menu_item_before');
            @endphp

            <li>
                <a href="#">
                    <i class="las la-newspaper-o fa-fw"></i>
                    @lang('admin.cms')
                    <span class="la arrow"></span>
                </a>
                <ul class="nav nav-second-level" style="display: none;">
                    <li> <a href="{{ route('admin.posts.index') }}">@lang('admin.posts')</a> </li>
                    <li> <a href="{{ route('admin.pages.index') }}">@lang('admin.pages')</a> </li>
                </ul><!-- /.nav-second-level -->
            </li>

            <li>
                <a href="{{route('admin.media_manager')}}"><i class="las la-photo-video"></i> @lang('admin.media_manager')</a>
            </li>

            <li>
                <a href="{{route('admin.categories.index')}}"><i class="las la-folder"></i> @lang('admin.categories')</a>
            </li>

            <li> <a href="{{route('admin.admin_courses')}}"><i class="las la-chalkboard"></i> @lang('admin.courses')</a>  </li>

            {{--<li>
                <a href="{{route('plugins')}}" class="{{request()->is('admin/plugins*') ? 'active' : ''}}" >
                    <i class="las la-plug"></i> @lang('admin.plugins')}}
                </a>
            </li>

            <li>
                <a href="{{route('themes')}}" class="{{request()->is('admin/themes*') ? 'active' : ''}}">
                    <i class="las la-brush"></i> @lang('admin.themes')}}
                </a>
            </li>--}}

            <li>
                <a href="#"><i class="las la-tools fa-fw"></i> @lang('admin.settings')<span class="la arrow"></span></a>
                <ul class="nav nav-second-level" style="display: none;">
                    @php
                        do_action('admin_menu_settings_item_before');
                    @endphp
                    <li> <a href="{{ route('admin.general_settings') }}">@lang('admin.general_settings')</a> </li>
                    <li> <a href="{{ route('admin.lms_settings') }}">@lang('admin.lms_settings')</a> </li>
                    <li> <a href="{{ route('admin.payment_settings') }}">@lang('admin.payment_settings')</a> </li>
                    <li> <a href="{{ route('admin.payment_gateways') }}">@lang('admin.payment_gateways')</a> </li>
                    <li> <a href="{{ route('admin.withdraw_settings') }}">@lang('admin.withdraw')</a> </li>
                    <li> <a href="{{ route('admin.theme_settings') }}">@lang('admin.theme_settings')</a> </li>
                    {{--<li> <a href="{{ route('invoice_settings') }}">@lang('admin.invoice_settings')</a> </li>--}}
                    <li> <a href="{{ route('admin.social_settings') }}"> @lang('admin.social_login_settings') </a> </li>
                    <li> <a href="{{ route('admin.storage_settings') }}"> @lang('admin.storage') </a> </li>
                    @php
                        do_action('admin_menu_settings_item_after');
                    @endphp
                </ul>
                <!-- /.nav-second-level -->
            </li>

            <li> <a href="{{route('admin.payments')}}">
                    <i class="las la-file-invoice-dollar"></i> @lang('admin.payments')}}</a>  </li>
            <li> <a href="{{route('admin.withdraws')}}">
                    <i class="las la-wallet"></i> @lang('admin.withdraws')</a>  </li>

            <li> <a href="{{ route('admin.users.index') }}"><i class="las la-users"></i> @lang('admin.users.index')</a>  </li>

            <li> <a href="{{route('admin.change_password')}}"><i class="las la-lock"></i> @lang('admin.change_password')</a>  </li>

            @php
            do_action('admin_menu_item_after');
            @endphp

            <li>
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="las la-sign-out"></i> @lang('admin.logout')
                </a>
            </li>

        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
