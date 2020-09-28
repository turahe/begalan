@extends('layouts.admin')

@section('content')


    <form action="{{route('profile_reset_password')}}" method="post">
        @csrf

        <div class="profile-basic-info bg-white p-3">

            <div class="form-row">
                <div class="form-group col-md-12 {{form_error($errors, 'old_password')->class}}">
                    <label for="old_password">{{__t('old_password')}}</label>
                    <input id="old_password" type="tel" class="form-control" name="old_password" >
                    {!! form_error($errors, 'old_password')->message !!}
                </div>

            </div>

            <div class="form-row">
                <div class="form-group col-md-6 {{form_error($errors, 'new_password')->class}}">
                    <label for="new_password">{{__t('new_password')}}</label>
                    <input id="new_password" type="tel" class="form-control" name="new_password" >
                    {!! form_error($errors, 'new_password')->message !!}
                </div>

                <div class="form-group col-md-6 {{form_error($errors, 'new_password_confirmation')->class}}">
                    <label for="new_password">{{__t('new_password_confirmation')}}</label>
                    <input id="new_password" type="tel" class="form-control" name="new_password_confirmation" >
                    {!! form_error($errors, 'new_password_confirmation')->message !!}
                </div>

            </div>


            <button type="submit" class="btn btn-info btn-lg"> Update Profile</button>


        </div>



    </form>




@endsection
