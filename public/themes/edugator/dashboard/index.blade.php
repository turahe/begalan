
<div class="dashboard-wrap">

    <div class="container py-4">
        <div class="row">
            <div class="col-3 dashboard-menu-col">
                <ul class="dashboard-menu">

                    <li class="{{request()->is('dashboard') ? 'active' : ''}}"><a href="{{route('dashboard')}}"> <i class="las la-dashboard"></i> Dashboard </a></li>

                    @if($auth_user->isInstructor())
                        <li class="{{request()->is('dashboard/courses/*') ? 'active' : ''}}">
                            <a href="{{route('create_course')}}"> <i class="las la-chalkboard-teacher"></i> Create new Course </a>
                        </li>
                        <li class="{{request()->is('dashboard/my-courses*') ? 'active' : ''}}">
                            <a href="{{route('my_courses')}}"> <i class="las la-graduation-cap"></i> {{__t('my_courses')}} </a>
                        </li>

                        <li><a href="#"> <i class="las la-comment-dollar"></i> Earnings </a></li>
                        <li><a href="#"> <i class="las la-wallet"></i> Withdrawal </a></li>
                        <li><a href="#"> <i class="las la-question"></i> Students Quiz Attempts </a></li>
                        <li class="border-top"></li>
                    @endif

                    <li><a href="#"> <i class="las la-user-cog"></i> My Profile </a></li>
                    <li><a href="#"> <i class="las la-pencil-square-o"></i> Enrolled Courses </a></li>
                    <li><a href="#"> <i class="las la-heart-o"></i> Wishlist </a></li>
                    <li><a href="#"> <i class="las la-star-half-alt"></i> Reviews </a></li>
                    <li><a href="#"> <i class="las la-question-circle-o"></i> My Quiz Attempts </a></li>
                    <li><a href="#"> <i class="las la-history"></i> Purchase History </a></li>
                    <li><a href="#"> <i class="las la-clipboard-list"></i> Assignments </a></li>
                    <li><a href="#"> <i class="las la-tools"></i> Settings </a></li>
                </ul>
            </div>

            <div class="col-9">
                @include(theme($view))
            </div>

        </div>
    </div>

</div>
