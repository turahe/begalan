@extends('layouts.theme', [
    'title' => __('front.checkout_pay')
])


@section('content')
    <div class="checkout-page-wrap py-5">

        <div class="container">
            <div class="col-md-12">

                <div class="section-order-summery-wrap mb-5">
                    <div class="checkout-section order-account-information-wrap bg-white  p-4 mt-3">
                        <div class="d-flex justify-content-center">
                            <button id="pay-button" class=" btn btn-primary btn-lg">Pay!</button>
                            <pre><div id="result-json">JSON result will appear here after payment:<br></div></pre>
                        </div>

                        <div class="checkout-agreement-wrap mt-4 text-center text-muted">
                            <p class="agreement-text"> {{__t('agreement_text')}} <br />
                                <strong>{{get_option('site_name')}}'s</strong>
                                <a href="{{route('post_proxy', get_option('terms_of_use_page'))}}">
                                    {{__t('terms_of_use')}}
                                </a> &amp; <a href="{{route('post_proxy', get_option('privacy_policy_page'))}}">
                                    {{__t('privacy_policy')}}
                                </a>
                            </p>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function(){
            // SnapToken acquired from previous step
            snap.pay('{{ $token }}', {
                // Optional
                onSuccess: function(result){
                    /* You may add your own js here, this is just example */
                    document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    window.location.href = "{{ route('payment_thank_you_page') }}";
                },
                // Optional
                onPending: function(result){
                    /* You may add your own js here, this is just example */
                    document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    window.location.href = "{{ route('payment_thank_you_page') }}";
                },
                // Optional
                onError: function(result){
                    /* You may add your own js here, this is just example */
                    document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    window.location.href = "{{ url('/') }}";
                }
            });
        };
    </script>
@endsection
