@if(session('success'))
    <div class="alert alert-success">
        <i class="lasla-check-circle"></i> {!! session('success') !!}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        <i class="lasla-info-circle"></i> {!! session('error') !!}
    </div>
@endif

@if($errors->count() > 0)
    <div class="alert alert-danger">
        <i class="lasla-info-circle"></i> @lang('admin.form_error')
    </div>
@endif
