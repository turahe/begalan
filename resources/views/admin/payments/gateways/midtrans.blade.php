
<div class="form-group row">
    <label class="col-md-4 control-label">{{__('admin.enable_disable')}} </label>
    <div class="col-md-6">
        {!! switch_field('enable_midtrans', '', get_option('enable_midtrans') ) !!}
    </div>
</div>


<div class="form-group row">
    <label class="col-md-4 control-label">{{__('admin.sandbox')}} </label>
    <div class="col-md-6">
        {!! switch_field('midtrans.test_mode', '', get_option('midtrans.test_mode') ) !!}
    </div>
</div>


<div class="form-group row">
    <label for="midtrans_id_merchant" class="col-sm-4 control-label">
        {{__('admin.id_merchant')}}
    </label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="midtrans_id_merchant" value="{{get_option('midtrans.id_merchant')}}" name="midtrans[id_merchant]">
    </div>
</div>


<div class="form-group row">
    <label for="midtrans_client_key" class="col-sm-4 control-label">
        {{__('admin.client_key')}}
    </label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="midtrans_client_key" value="{{get_option('midtrans.client_key')}}" name="midtrans[client_key]">

    </div>
</div>

<div class="form-group row">
    <label for="midtrans_server_Key" class="col-sm-4 control-label">
        {{__('admin.server_key')}}
    </label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="midtrans_server_Key" value="{{ get_option('midtrans.server_Key')}}" name="midtrans[server_Key]">

    </div>
</div>

