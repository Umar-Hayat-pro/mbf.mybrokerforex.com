@extends($activeTemplate.'layouts.master')
@section('content')

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card custom--card">
            <div class="card-header">
                <h5 class="card-title">@lang('Razorpay')</h5>
            </div>
            <div class="card-body pt-0">
                <ul class="list-group text-center list-group-flush">
                    <li class="list-group-item d-flex justify-content-between">
                        @lang('You have to pay '):
                        <strong>{{showAmount($deposit->final_amount)}} {{__($deposit->method_currency)}}</strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        @lang('You will get '):
                        <strong>{{showAmount($deposit->amount)}}  {{__($deposit->method_currency)}}</strong>
                    </li>
                </ul>
                 <form action="{{$data->url}}" method="{{$data->method}}">
                    <input type="hidden" custom="{{$data->custom}}" name="hidden">
                    <script src="{{$data->checkout_js}}"
                            @foreach($data->val as $key=>$value)
                            data-{{$key}}="{{$value}}"
                        @endforeach >
                    </script>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection


@push('script')
    <script>
        (function ($) {
            "use strict";
            $('input[type="submit"]').addClass("mt-4 btn btn--base w-100");
        })(jQuery);
    </script>
@endpush
