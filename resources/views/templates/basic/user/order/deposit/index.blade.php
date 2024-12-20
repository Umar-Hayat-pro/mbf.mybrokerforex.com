@extends($activeTemplate . 'layouts.master')

@section('content')
<div class="row gy-4 justify-content-center">
    <div class="col-12">
        <div class="dashboard-header-menu d-flex justify-content-between align-items-center">
            <h4 class="mb-0">{{ __($pageTitle) }}</h4>
            <a href="{{ route('user.deposit.history') }}"  class="btn btn--base outline btn--sm trade-btn">
              <span class="icon-deposit"></span> @lang('Deposit History')
            </a>
          </div>
    </div>
    
    <div class="right-sidebar mt-3" style="background-color: white; border:1px solid rgb(52, 50, 50);">
      <div class="right-sidebar__header mb-3 skeleton">
        <h4 class="mb-0 fs-18">@lang('Make crypto & flat deposits in a few steps')</h4>
      </div>
      <div class="right-sidebar__deposit">
        <form class="skeleton deposit-form">
          <div class="form-group position-relative" id="currency_list_wrapper">
            <div class="input-group">
              <input type="number" step="any" name="amount" class="form--control form-control"
                placeholder="@lang('Amount')">
              <div class="input-group-text skeleton">
                <x-currency-list :action="route('user.currency.all')" valueType="2" logCurrency="true" />
              </div>
            </div>
          </div>
          <button class="deposit__button btn btn--base w-100" type="submit">
            <span class="icon-deposit"></span> @lang('Deposit')
          </button>
        </form>
      </div>
    </div>
  <x-flexible-view :view="$activeTemplate . 'user.components.canvas.deposit'" :meta="['gateways' => $gateways]" />
@endsection

@push('script-lib')
  <script src="{{ asset('assets/global/js/select2.min.js') }}"></script>
@endpush

@push('style-lib')
  <link rel="stylesheet" href="{{ asset('assets/global/css/select2.min.css') }}">
@endpush

@push('script')
  <script>
    "use strict";
    (function($) {
      // JavaScript code for deposit section
    })(jQuery);
  </script>
@endpush
