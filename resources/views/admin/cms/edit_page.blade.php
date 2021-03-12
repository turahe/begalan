@extends('layouts.app', [
    'title' => 'Edit page'
])



@section('content')
    <a href="{{route('admin.pages.create')}}" class="btn btn-success mr-3" data-toggle="tooltip" title="@lang('create_new_page')}}"> <i class="las la-plus-circle"></i> @lang('create_new_page')}} </a>

    <a href="{{route('admin.pages.index')}}" class="btn btn-info" data-toggle="tooltip" title="@lang('pages')}}"> <i class="las la-list"></i> @lang('pages')}} </a>

    <div class="row">
        <div class="col-sm-12">

            <form action="" method="post" id="createPostForm" enctype="multipart/form-data">
                @csrf

                <div class="form-group row {{ $errors->has('title')? 'has-error':'' }}">
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="title" value="{{ old('title')?old('title'): $page->title }}" name="title" placeholder="@lang('title')}}">
                        {!! $errors->has('title')? '<p class="help-block">'.$errors->first('title').'</p>':'' !!}
                    </div>
                </div>

                <div class="form-group row {{ $errors->has('content')? 'has-error':'' }}">
                    <div class="col-sm-12">
                        <textarea name="content" id="content" class="form-control">{!!  old('content')? old('content'): $page->content !!}</textarea>
                        {!! $errors->has('content')? '<p class="help-block">'.$errors->first('content').'</p>':'' !!}
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-9">
                        <button type="submit" class="btn btn-primary">@lang('update_page')}}</button>
                    </div>
                </div>
            </form>

        </div>

    </div>

@endsection

@section('page-js')
    <script src="{{ asset('assets/plugins/ckeditor/ckeditor.js') }}"></script>
    <script>
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace( 'content' );
    </script>
@endsection
