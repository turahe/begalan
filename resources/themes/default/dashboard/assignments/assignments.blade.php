@extends('theme::dashboard.layout')


@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('courses_has_assignments')}}">@lang('theme.courses')</a></li>
            <li class="breadcrumb-item"><a href="{{route('courses_assignments', $course->id)}}">@lang('theme.assignments')</a></li>
            <li class="breadcrumb-item active" aria-current="page">@lang('theme.assignment_submission')</li>
            <li class="breadcrumb-item active">@lang('theme.evaluate_submission')</li>
        </ol>
    </nav>

    @if($assignments->count())
        <table class="table table-bordered bg-white table-striped">

           <thead>
           <tr>
               <th>@lang('theme.assignments') @lang('theme.title')</th>
           </tr>
           </thead>

            @foreach($assignments as $assignment)

                <tr>
                    <td>
                        <p class="mb-3">
                            <strong>
                                <a href="{{route('assignment_submissions', $assignment->id)}}">{{$assignment->title}}</a>
                            </strong>
                        </p>

                        <div class="course-list-lectures-counts text-muted">
                            <p class="m-0">@lang('theme.submissions')}} : {{$assignment->submissions->count()}}</p>
                        </div>

                    </td>

                </tr>

            @endforeach

        </table>


        {!! $assignments->links() !!}

    @else
        {!! no_data() !!}
    @endif




@endsection
