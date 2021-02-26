@extends('theme::layouts.theme', [
    'title' => 'Topics'
])

@section('content')

    <div class="page-header-wrapper bg-light-sky py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class='breadcrumb mb-0'>
                            <li class='breadcrumb-item'>
                                <a href='{{route('home')}}'>
                                    <i class='la la-home'></i>  @lang('theme.home')
                                </a>
                            </li>

                            <li class='breadcrumb-item active'>@lang('theme.topics')</li>
                        </ol>
                    </nav>
                    <h1 class="mb-3">@lang('theme.topics')</h1>
                </div>
            </div>
        </div>

    </div>


    <div class="categories-wrap my-5">

        <div class="container">
            <div class="row">

                @foreach($categories as $category)
                    <div class="col-md-4">
                        <div class="category-item-name">

                            <a href="{{route('category.view', $category->slug)}}" style="background-color: {{$category->bg_color}};" class="py-4 d-block text-center text-white mb-3 ">
                                <i class="las {{$category->icon_class}}"></i> {{$category->name}}
                            </a>
                        </div>
                    </div>
                @endforeach

            </div>

        </div>

    </div>


    @if($categories->count())
        <div class="categories-courses-wrapper">
            <div class="container">
                @foreach($categories as $category)
                    <div class="row">
                        <div class="col-md-12">
                            <div class="section-header-wrap">
                                <h4 class="section-title"> <span class="text-muted">@lang('theme.new_arrival_in')</span>
                                    <a href="{{ $category->url }}">
                                        <i class="las {{$category->icon_class}}"></i> {{$category->name}}
                                    </a>
                                </h4>
                            </div>
                        </div>
                    </div>

                    <div class="category-courses-cards-wrap mt-3">
                        <div class="row">
                            @foreach($category->courses()->take(4)->get() as $course)
                                @include('theme::template-part.course-loop', ['course' => $course]);
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    @else

        {!! no_data() !!}

    @endif

@endsection
