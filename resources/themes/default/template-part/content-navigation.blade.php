@php
    $previous = $content->previous;
    $next = $content->next;
    $is_completed = false;
    if (auth()->user() && $content->is_completed){
        $is_completed = true;
    }
@endphp

<div class="lecture-header d-flex">
    <div class="lecture-header-left d-flex">
        <a href="{{route('course', $course->slug)}}" class="back-to-curriculum" data-toggle="tooltip" title="@lang('theme.go_to_course')}}">
            <i class="las la-angle-left"></i>
        </a>

        <a href="javascript:;" class="nav-icon-list d-sm-block d-md-none d-lg-none"><i class="las la-list"></i> </a>

        @if(auth()->user() && ! auth()->user()->is_completed_course($course->id))
            <form action="{{route('course_complete', $course->id)}}" method="post" class="ml-auto">
                @csrf
                <button type="submit" href="javascript:;" class="nav-icon-complete-course btn btn-success ml-auto" data-toggle="tooltip" title="@lang('theme.complete_course')}}" >
                    <i class="las la-check-circle"></i>
                </button>
            </form>
        @endif
    </div>
    <div class="lecture-header-right d-flex">

        @if($previous)
            <a class="nav-btn" href="{{route('single_'.$previous->item_type, [$course->slug, $previous->id ] )}}" id="lecture_previous_button">

                <span class="nav-text">
                    <i class="las la-arrow-left"></i>
                    @lang('theme.previous')}} @lang($theme. $previous->item_type)
                </span>
            </a>
        @else
            <a class="nav-btn disabled" id="lecture_previous_button">
                <span class="nav-text"><i class="las la-arrow-left"></i>@lang('theme.previous')}}</span>
            </a>
        @endif

        @if($next)
            @if($content->item_type === 'lecture')
                <a class="nav-btn" href="{{route('content_complete', $content->id )}}" id="lecture_complete_button">
                    <span class="nav-text">
                        @if($is_completed)
                            @lang('theme.next')}} {{$next ? __t($next->item_type) : ''}}
                        @else
                            @lang('theme.complete_continue')}}
                        @endif

                        <i class="las la-arrow-right"></i>
                    </span>
                </a>
            @else
                <a class="nav-btn" href="{{route('single_'.$next->item_type, [$course->slug, $next->id ] )}}" id="lecture_complete_button">
                    <span class="nav-text">@lang('theme.next')}} {{$next ? __t($next->item_type) : ''}} <i class="las la-arrow-right"></i></span>

                </a>
            @endif
        @else

            @if($content->item_type === 'lecture')
                @if($is_completed)
                    <a class="nav-btn disabled" id="lecture_complete_button">
                        <span class="nav-text">@lang('theme.complete')}} </span>
                    </a>
                @else
                    <a class="nav-btn" href="{{route('content_complete', $content->id)}}" id="lecture_complete_button">
                        <span class="nav-text"> <i class="las la-check-circle"></i> @lang('theme.complete')}} </span>
                    </a>
                @endif
            @else
                <a class="nav-btn disabled" id="lecture_complete_button">
                    <span class="nav-text">@lang('theme.next')}} <i class="las la-arrow-right"></i></span>
                </a>
            @endif

        @endif

    </div>
</div>
