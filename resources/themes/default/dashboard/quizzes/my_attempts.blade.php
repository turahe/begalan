@extends('theme::dashboard.layout')


@section('content')

    @php
        $attempts = auth()->user()->my_quiz_attempts()->with('user', 'quiz', 'course')->orderBy('ended_at', 'desc')->get();
    @endphp

    @if( $attempts->count())

        <table class="table table-bordered bg-white table-striped">

            <tr>
                <th>#</th>
                <th>@lang('theme.details')}}</th>
            </tr>

            @foreach($attempts as $attempt)

                <tr>
                    <td>#</td>
                    <td>
                        <p class="mb-3">{{$attempt->user->name}}</p>

                        <p class="mb-0 text-muted">
                            <strong>@lang('theme.quiz')}} : </strong> <a href="{{$attempt->quiz->url}}">{{$attempt->quiz->title}}</a>
                        </p>
                        <p class="mb-0 text-muted">
                            <strong>@lang('theme.course')}} : </strong> <a href="{{$attempt->course->url}}">{{$attempt->course->title}}</a>
                        </p>
                    </td>
                </tr>

            @endforeach

        </table>

    @else
        {!! no_data() !!}
    @endif

@endsection
