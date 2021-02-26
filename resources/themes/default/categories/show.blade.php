@extends('theme::layouts.theme')


@section('content')

    <div class="page-header-wrapper bg-light-sky py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <nav aria-label="breadcrumb">
                        {!! generateBreadcrumb($category) !!}
                    </nav>

                    <h1 class="mb-3">{{$category->name}}</h1>

                    @if($category->sub_categories->count())

                        <div class="sub-categories-link-wrapper">
                            @foreach($category->sub_categories as $subCat)
                                <a href="{{ $subCat->url }}" class="btn btn-sm btn-warning mb-2" > {{$subCat->name}} </a>
                            @endforeach
                        </div>
                    @endif
                </div>

            </div>
        </div>

    </div>


    @php
    $courses = $category->courses()->paginate(20);
    @endphp

    @if($courses->total())
        <div class="categories-course-wrapper my-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-header-wrap">
                            <p class="text-muted my-3"> Showing {{$courses->count()}} from {{$courses->total()}} results </p>
                        </div>
                    </div>
                </div>

                <div class="popular-courses-cards-wrap mt-3">
                    <div class="row">
                        @foreach($courses as $course)
                            @include('theme::template-part.course-loop', ['course' => $course])
                        @endforeach
                    </div>
                </div>
                {!! $courses->links() !!}
            </div>
        </div>

    @else
        {!! no_data(); !!}
    @endif

@endsection
