@extends('theme::layouts.theme')

@section('content')

    <div class="container-fluid bg-light-sky">

        <div class="row">
            <div class="col-md-12 d-flex justify-content-center">
                <div class="payment-thankyou-wrap text-center py-5">
                    <img alt="success" src="{{theme_url('images/payment-success.png')}}" />

                    <h1 class="mb-4 text-success">
                        <i class="las la-check-circle"></i>
                        {{__t('thank_you')}}
                    </h1>
                    <div class="thankyou-payment-text-details my-4">
                        {{__t('payment_receive_successfully')}}
                    </div>
                    <div class="error-actions">
                        <a href="{{route('home')}}" class="btn btn-light btn-lg">
                            <span class="las la-home"></span>
                            Take Me Home
                        </a>
                    </div>
                </div>

            </div>
        </div>

    </div>

@endsection
