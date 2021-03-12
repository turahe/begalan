@extends('layouts.app', [
    'title' => 'Create category'
])



@section('content')
    <a href="{{route('admin.categories.index')}}" class="btn btn-secondary btn-xl mr-1" data-toggle="tooltip" title="@lang('admin.categories')">
        <i class="las la-folder-open"></i>
    </a>

    <button type="submit" form="form-category" class="btn btn-success btn-xl" data-toggle="tooltip" title="@lang('admin.save')">
        <i class="las la-save"></i>
    </button>
    <form action="" id="form-category" method="post" enctype="multipart/form-data"> @csrf

        <div class="row">

            <div class="col-md-12">

                <div class="form-group row {{ $errors->has('name')? 'has-error':'' }} ">
                    <label class="col-sm-3 control-label" for="name">@lang('admin.name')</label>
                    <div class="col-sm-7">
                        <input type="text" name="name" value="" placeholder="@lang('admin.name')" id="name" class="form-control">
                        {!! $errors->has('name')? '<p class="help-block">'.$errors->first('name').'</p>':'' !!}
                    </div>
                </div>

                <div class="form-group row {{ $errors->has('parent')? 'has-error':'' }} ">
                    <label class="col-sm-3 control-label" for="parent">@lang('admin.parent')</label>
                    <div class="col-sm-7">
                        <select name="parent" id="parent" class="form-control select2">
                            <option value="0">@lang('admin.select_category')</option>
                            @if($categories->count() > 0)
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}"> {!! $category->name !!} </option>
                                    @foreach($category->sub_categories as $subCategory)
                                        <option value="{{$subCategory->id}}"> &nbsp;&nbsp;&nbsp; &raquo; {!! $subCategory->name !!} </option>
                                    @endforeach
                                @endforeach
                            @endif
                        </select>

                        {!! $errors->has('parent')? '<p class="help-block">'.$errors->first('parent').'</p>':'' !!}
                    </div>
                </div>



                <div class="form-group row">
                    <label class="col-sm-3 control-label" for="description">@lang('admin.status')</label>
                    <div class="col-sm-7">
                        <label><input type="radio" name="status" value="1" checked="checked"> @lang('admin.publish')}}</label> <br />
                        <label><input type="radio" name="status" value="0"> @lang('admin.unpublish')</label>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-7 offset-3">
                        <button type="submit" form="form-category" class="btn btn-success btn-xl" data-toggle="tooltip" title="@lang('admin.save')">
                            <i class="las la-save"></i>
                            @lang('admin.save')
                        </button>
                    </div>
                </div>


            </div>

        </div>

    </form>

@endsection
