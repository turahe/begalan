@extends('layouts.app', [
    'title' => 'Create Page'
])




@section('content')
    <a href="{{route('admin.pages.index')}}" class="btn btn-info" data-toggle="tooltip" title="@lang('admin.pages')}}"> <i class="las la-list"></i> @lang('admin.pages')}} </a>

    <div class="row">
        <div class="col-sm-12">

            <form action="" method="post" id="createPostForm" enctype="multipart/form-data">
                @csrf

                <div class="form-group row {{ $errors->has('title')? 'has-error':'' }}">
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="title" value="{{ old('title') }}" name="title" placeholder="@lang('admin.title')}}">
                        {!! $errors->has('title')? '<p class="help-block">'.$errors->first('title').'</p>':'' !!}
                    </div>
                </div>

                <div class="form-group row {{ $errors->has('content')? 'has-error':'' }}">
                    <div class="col-sm-12">
                        <textarea name="content" id="content" class="form-control" rows="6">{{ old('content') }}</textarea>
                        {!! $errors->has('content')? '<p class="help-block">'.$errors->first('content').'</p>':'' !!}
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-9">
                        <button type="submit" class="btn btn-primary">@lang('admin.create_new_page')}}</button>
                    </div>
                </div>
            </form>

        </div>

    </div>


@endsection

@section('page-js')
    <script src="{{ asset('assets/plugins/ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace( 'content' );
    </script>
@endsection
