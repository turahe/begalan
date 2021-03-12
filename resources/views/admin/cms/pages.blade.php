@extends('layouts.app', [
    'title' => 'All pages'
])

@section('page-header-right')
    <a href="{{route('admin.pages.create')}}" class="btn btn-success" data-toggle="tooltip" title="@lang('admin.create_new_page')}}"> <i class="las la-plus-circle"></i> @lang('admin.create_new_page')}} </a>
@endsection

@section('content')

    <form action="" method="get">

        <div class="row mb-4">

            <div class="col-md-12">
                <div class="input-group">
                    <select name="status" class="mr-3">
                        <option value="">@lang('admin.set_status')</option>

                        <option value="1">Publish</option>
                        <option value="2">Unpublish</option>
                    </select>

                    <button type="submit" name="bulk_action_btn" value="update_status" class="btn btn-primary mr-2">
                        <i class="las la-refresh"></i> @lang('admin.update')
                    </button>
                    <button type="submit" name="bulk_action_btn" value="delete" class="btn btn-danger delete_confirm">
                        <i class="las la-trash"></i>
                        @lang('admin.delete')
                    </button>
                </div>
            </div>

        </div>


        <div class="row">
            <div class="col-sm-12">

                @if($pages->count())

                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th><input class="bulk_check_all" type="checkbox" /></th>
                        <th>@lang('admin.title')</th>
                        <th>@lang('admin.published_time')</th>
                        <th>@lang('admin.actions')</th>
                    </tr>
                    </thead>

                    @foreach($pages as $page)
                        <tr>
                            <td>
                                <label>
                                    <input class="check_bulk_item" name="bulk_ids[]" type="checkbox" value="{{$page->id}}" />
                                    <small class="text-muted">#{{$page->id}}</small>
                                </label>
                            </td>
                            <td>{{$page->title}} {!! $page->status_context !!}</td>
                            <td>{{$page->created_at}}</td>

                            <td>
                                <a href="{{route('admin.pages.edit',$page->id)}}" class="btn btn-primary">
                                    <i class="las la-edit"></i>
                                </a>
                                <a href="{{route('admin.pages.show', $page->slug)}}" class="btn btn-purple">
                                    <i class="las la-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach

                </table>

                @else
                    {!! no_data() !!}
                @endif

                {!! $pages->links() !!}

            </div>
        </div>

    </form>

@endsection
