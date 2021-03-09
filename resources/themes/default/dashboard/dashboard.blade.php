@extends('theme::dashboard.layout', [
    'title' => 'Dashboard'
])

@section('content')

    <div class="row">
        <div class="col-lg-4 col-md-6">
            <div class="dashboard-card mb-3 d-flex border p-3 bg-light">
                <div class="card-icon mr-2">
                    <span><i class="las la-user"></i> </span>
                </div>

                <div class="card-info">
                    <div class="text-value"><h4>{{ Auth::user()->enrolls_count }}</h4></div>
                    <div>Courses Enrolled</div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="dashboard-card mb-3 d-flex border p-3 bg-light">
                <div class="card-icon mr-2">
                    <span><i class="las la-heart"></i> </span>
                </div>

                <div class="card-info">
                    <div class="text-value"><h4>{{ Auth::user()->wishlist_count }}</h4></div>
                    <div>In Wishlist</div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="dashboard-card mb-3 d-flex border p-3 bg-light">
                <div class="card-icon mr-2">
                    <span><i class="las la-star-half-alt"></i> </span>
                </div>

                <div class="card-info">
                    <div class="text-value"><h4>{{ Auth::user()->reviews_count }}</h4></div>
                    <div>My Reviews</div>
                </div>
            </div>
        </div>

    </div>

    @if($chartData)
        <div class="p-4 bg-white">
            <h4 class="mb-4">My Earning for for the month ({{date('M')}})</h4>

            <canvas id="ChartArea"></canvas>
        </div>
    @endif

    @if(Auth::user()->purchases_count > 0)
        <h4 class="my-4"> {{sprintf(__('my_last_purchases'), $purchases->count())}} </h4>

        <table class="table table-striped table-bordered">

            <tr>
                <th>#</th>
                <th>@lang('admin.amount')</th>
                <th>@lang('admin.method')</th>
                <th>@lang('admin.time')</th>
                <th>@lang('admin.status')</th>
                <th>#</th>
            </tr>

            @foreach($purchases as $purchase)
                <tr>
                    <td>
                        <small class="text-muted">#{{$purchase->id}}</small>
                    </td>
                    <td>
                        {!!price_format($purchase->amount)!!}
                    </td>
                    <td>{!!ucwords(str_replace('_', ' ', $purchase->payment_method))!!}</td>

                    <td>
                        <small>
                            {!!$purchase->created_at->format(get_option('date_format'))!!} <br />
                            {!!$purchase->created_at->format(get_option('time_format'))!!}
                        </small>
                    </td>

                    <td>
                        {!! $purchase->status_context !!}
                    </td>
                    <td>
                        @if($purchase->status == 'success')
                            <span class="text-success" data-toggle="tooltip" title="{!!$purchase->status!!}"><i class="fa fa-check-circle-o"></i> </span>
                        @else
                            <span class="text-warning" data-toggle="tooltip" title="{!!$purchase->status!!}"><i class="fa fa-exclamation-circle"></i> </span>
                        @endif

                        <a href="{!!route('purchase_view', $purchase->id)!!}" class="btn btn-info"><i class="las la-eye"></i> </a>
                    </td>
                </tr>
            @endforeach
        </table>
    @endif

@endsection

@section('page-js')

    @if($chartData)
        <script src="{{asset('assets/plugins/chartjs/Chart.min.js')}}"></script>

        <script>
            var ctx = document.getElementById("ChartArea").getContext('2d');
            var ChartArea = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: {!! json_encode(array_keys($chartData)) !!},
                    datasets: [{
                        label: 'Earning ',
                        backgroundColor: '#216094',
                        borderColor: '#216094',
                        data: {!! json_encode(array_values($chartData)) !!},
                        borderWidth: 2,
                        fill: false,
                        lineTension: 0,
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                min: 0, // it is for ignoring negative step.
                                beginAtZero: true,
                                callback: function(value, index, values) {
                                    return '{{get_currency()}} ' + value;
                                }
                            }
                        }]
                    },
                    tooltips: {
                        callbacks: {
                            label: function(t, d) {
                                var xLabel = d.datasets[t.datasetIndex].label;
                                var yLabel = t.yLabel >= 1000 ? '$' + t.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") : '{{get_currency()}} ' + t.yLabel;
                                return xLabel + ': ' + yLabel;
                            }
                        }
                    },
                    legend: {
                        display: false
                    }
                }
            });
        </script>
    @endif
@endsection
