<ul class="dashboard-menu">
    <li class="{{request()->is('dashboard') ? 'active' : ''}}"><a href="{{route('dashboard')}}"> <i
                    class="las la-dashboard"></i> @lang('dashboard') </a></li>

    @php
        $menus = dashboard_menu();
    @endphp

    @if(is_array($menus) && count($menus))
        @foreach($menus as $key => $instructor_menu)
            <li class="{{array_get($instructor_menu, 'is_active') ? 'active' : ''}}">
                <a href="{{route($key)}}"> {!! array_get($instructor_menu, 'icon') !!} {!! array_get($instructor_menu, 'name') !!} </a>
            </li>
        @endforeach
    @endif

    <li>
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="las la-sign-out"></i> @lang('logout')
        </a>
    </li>
</ul>
