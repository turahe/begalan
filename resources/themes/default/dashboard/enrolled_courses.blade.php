@extends('theme::dashboard.layout')

@section('content')

    @if(auth()->user()->enrolls_count)
        <table class="table table-bordered bg-white">

            <tr>
                <th>@lang('theme.thumbnail')}}</th>
                <th>@lang('theme.title')}}</th>
                <th>@lang('theme.price')}}</th>
                <th>#</th>
            </tr>

            @foreach(auth()->user()->enrolls as $course)
                <tr>
                    <td>
                        <img src="{{$course->thumbnail_url}}" width="80" />
                    </td>
                    <td>
                        <p class="mb-3">
                            <strong>{{$course->title}}</strong>
                            {!! $course->status_html() !!}
                        </p>

                        <p class="m-0 text-muted">
                            @php
                            $lectures_count = $course->lectures->count();
                            $assignments_count = $course->assignments->count();
                            $quizzes_count = $course->quizzes->count();
                            @endphp

                            <span class="course-list-lecture-count">{{$lectures_count}} @lang('theme.lectures')}}</span>

                            @if($assignments_count)
                                , <span class="course-list-assignment-count">{{$assignments_count}} @lang('theme.assignments')}}</span>
                            @endif

                            @if($quizzes_count)
                                , <span class="course-list-assignment-count">{{$quizzes_count}} @lang('theme.quizzes')}}</span>
                            @endif

                        </p>
                    </td>
                    <td>{!! $course->price_html() !!}</td>

                    <td>
                        @if($course->status == 1)
                            <a href="{{route('course', $course->slug)}}" class="btn btn-sm btn-primary mt-2" target="_blank"><i class="las la-eye"></i> @lang('theme.view')}} </a>
                        @endif
                    </td>
                </tr>

            @endforeach

        </table>
    @else
        {!! no_data(null, null, 'my-5' ) !!}
    @endif

@endsection
