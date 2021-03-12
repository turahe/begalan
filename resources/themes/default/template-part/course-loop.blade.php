<div class="col-md-3 course-card-grid-wrap ">
    <div class="course-card mb-5">

        <div class="course-card-img-wrap">
            <a href="{{route('course', $course->slug)}}">
                <img class="img-fluid" src="{{ $course->cover }}" alt="{{ $course->title }}">
            </a>

            <button class="course-card-add-wish btn btn-link btn-sm p-0" data-course-id="{{$course->id}}">
                @if(auth()->user() && in_array($course->id, auth()->user()->get_option('wishlists', []) ))
                    <i class="la la-heart"></i>
                @else
                    <i class="la la-heart-o"></i>
                @endif
            </button>
        </div>

        <div class="course-card-contents">
            <a href="{{route('course', $course->slug)}}">
                <h4 class="course-card-title mb-3">{{$course->title}}</h4>
                <p class="course-card-short-info mb-2 d-flex justify-content-between">
                    <span><i class="las la-play-circle"></i>
                        {{$course->total_lectures}} @lang('theme.lectures')
                    </span>
                    <span><i class="las la-signal"></i> {{course_levels($course->level)}}</span>
                </p>
            </a>

            <div class="course-card-info-wrap">
                <p class="course-card-author d-flex justify-content-between">
                    <span>
                        <i class="las la-user"></i> by <a href="{{route('profile', $course->user_id)}}">{{$course->author->name}}</a>
                    </span>
                    @if($course->category)
                        <span>
                            <i class="las la-folder"></i> in <a href="{{ $course->category->url }}">{{$course->category->name}}</a>
                        </span>
                    @endif
                </p>
                @if($course->rating_count)
                    <div class="course-card-ratings">
                        <div class="star-ratings-group d-flex">
                            {!! star_rating_generator($course->rating_value) !!}
                            <span class="star-ratings-point mx-2"><b>{{$course->rating_value}}</b></span>
                            <span class="text-muted star-ratings-count">({{$course->rating_count}})</span>
                        </div>
                    </div>
                @endif
            </div>

            <div class="course-card-footer mt-3">
                <div class="course-card-cart-wrap d-flex justify-content-between">
                    {!! $course->price_html(false, false) !!}

                    <div class="course-card-btn-wrap">
                        @if(auth()->user() && in_array($course->id, auth()->user()->get_option('enrolled_courses', []) ))
                            <a href="{{route('course', $course->slug)}}">@lang('theme.enrolled')</a>
                        @else
                            @php($in_cart = cart($course->id))
                            <button type="button" class="btn btn-sm btn-theme-primary add-to-cart-btn"  data-course-id="{{$course->id}}" {{$in_cart? 'disabled="disabled"' : ''}}>
                                @if($in_cart)
                                    <i class='la la-check-circle'></i> @lang('theme.in_cart')
                                @else
                                    <i class="las la-shopping-cart"></i> @lang('theme.add_to_cart')
                                @endif
                            </button>
                        @endif
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
