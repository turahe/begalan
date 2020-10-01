@extends('layouts.admin')

@section('content')

    <div class="container pt-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="list-group">
                    @forelse(Auth::user()->notifications as $notification)
                        <a href="{{ route('notifications.show', $notification->id) }}" class="list-group-item list-group-item-action flex-column align-items-start {{  $notification->read() == null ? 'active' : '' }}">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">{{ __('admin.' . snake_case(class_basename($notification->type))) }}</h5>
                                <small>{{ $notification->created_at->diffForHumans() }}</small>
                            </div>
                            <p class="mb-1">{{ __($notification->data['description'], ['name' => $notification->data['name'], 'course' => $notification->data['course'], 'amount' => $notification->data['amount']]) }}</p>
                                                        <small>{{ $notification->data['transaction_id'] }}</small>
                        </a>
                </div>
                @empty
                    <div class="row justify-content-center">
                        <div class="col-lg-12 text-center p-3">
                            <img src="{{ '/' }}" class="img-fluid">
                            <h3 class="mt-3">@lang('admin.no_available_data')</h3>
                            <h6 class="text-danger mb-4">
                                @lang('admin.no_available_data')
                            </h6>
                        </div>
                    </div>
                @endforelse

            </div>
        </div>
    </div>

@endsection
