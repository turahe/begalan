

<a class="nav-link" href="javascript:;" id="miniCartDropDown">
    <div class="text-center">
        <i class="las la-bell"></i>
        @if(Auth::user()->unreadNotifications->count())
            <span class="badge badge-pill badge-danger">{{ Auth::user()->unreadNotifications->count() }}</span>
        @endif
    </div>
</a>

@if(Auth::user()->unreadNotifications())
    <div class="mini-cart-body-wrap">
        <div class="mini-cart-courses-list-wrap">
            @foreach(Auth::user()->unreadNotifications as $index => $notification)
                <div class="mini-cart-course-item">
                    <a href="{{ route('notifications.show', $notification->id) }}" class="d-block p-3 d-flex">
                        <div class="minicart-course-info flex-grow-1">
                            <p class="mini-cart-course-title mb-1">{{ __('admin.' . snake_case(class_basename($notification->type))) }}</p>
                            <div class="mini-cart-course-price">
                                {{ $notification->created_at->diffForHumans() }}
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        <div class="mini-cart-total-wrap pt-4">
            <a href="{{route('notifications')}}" class="btn btn-block btn-info">
                {{__t('all_notifications')}}
            </a>
        </div>
    </div>
@endif
