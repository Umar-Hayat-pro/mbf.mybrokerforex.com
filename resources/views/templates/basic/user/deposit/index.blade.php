@extends($activeTemplate . 'layouts.master')

@section('content')
<div class="row gy-4 justify-content-between">
  <div class="col-12">
    <div class="dashboard-header-menu d-flex flex-sm-row flex-column justify-content-between">
      <h4 class="mb-0">{{ __($pageTitle) }}</h4>
      <a href="{{ route('user.deposit.history') }}" class="btn btn--base outline btn--sm trade-btn">
        <span class="icon-deposit"></span> @lang('Deposit History')
      </a>
    </div>
  </div>

  <!-- Card 1: Deposit Form -->
  <div class="col-md-6">
    <div class="card">
      <div class="card-header bg-transparent text-center">
        <span class="mb-0 fs-18">@lang('Make your deposits in a few steps')</span>
      </div>
      <div class="card-body">
        <form class="deposit-form">
          <div class="form-group" id='currency_list_wrapper'>

            <label for="amount" class="form-label">@lang('Amount')</label>
            <input type="number" step="any" name="amount" id="amount" class="form-control "
              placeholder="@lang('Enter amount')">
          </div>

          <div class="form-group mt-3">
            <label for="account-number" class="form-label">@lang('Select Account')</label>
            <select name="account-number" id="account-number" class="form-select">
              <option value="" disabled selected>@lang('Select Account')</option>
              @foreach ($real as $acc)
          <option value="{{ $acc->Login }}">
          {{ "{$acc->Name} ({$acc->Login})" }}
          </option>
        @endforeach
            </select>
          </div>

          <div class="form-group mt-3">
            <label for="currency" class="form-label">@lang('Select Currency')</label>
            <button type="button" class="btn btn-secondary w-100" data-bs-toggle="modal">
              <x-currency-list :action="route('user.currency.all')" valueType="2" logCurrency="true" />
            </button>
          </div>
          <button class="btn btn--base w-100 mt-3" type="submit">
            <span class="icon-deposit"></span> @lang('Deposit')
          </button>
        </form>
      </div>
    </div>
  </div>

  <!-- Card 2: Deposit Details -->
  <div class="col-md-6">
    <div class="card">
      <div class="card-header bg-transparent text-center">
        <span class="mb-0 fs-18">@lang('Deposit Details')</span>
      </div>
      <div class="card-body">
        <ul class="list-group">
          <li class="list-group-item d-flex justify-content-between">
            <span>@lang('Amount:')</span>
            <span id="amountDisplay">--</span>
          </li>
          <li class="list-group-item d-flex justify-content-between">
            <span>@lang('Account Number:')</span>
            <span id="accountDisplay">--</span>
          </li>
        </ul>
      </div>
    </div>
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
  (function ($) {
    $(document).ready(function () {
      // DOM elements
      const amountInput = $('input[name="amount"]');
      const amountDisplay = $('#amountDisplay');
      const accountSelect = $('#account-number');
      const accountDisplay = $('#accountDisplay');

      // Update amountDisplay on amount input change
      amountInput.on('input', function () {
        amountDisplay.text($(this).val() || '--'); // Show amount or '--' if empty
      });

      // Update accountDisplay on account selection change
      accountSelect.on('change', function () {
        const selectedAccount = $(this).find('option:selected').text(); // Get selected text
        accountDisplay.text(selectedAccount || '--'); // Update display or fallback to '--'
      });
    });
  })(jQuery);
</script>
@endpush



<!-- @push('script')
  <script>
    "use strict";
    (function ($) {
    // Synchronize inputs and details card
    const amountInput = $('input[name="amount"]');
    const amountDisplay = $('#amountDisplay');
    const currencySelect = $('#currency_list_wrapper button');
    const currencyDisplay = $('#currencyDisplay');

    amountInput.on('input', function () {
      amountDisplay.text($(this).val() || '--');
    });

    currencySelect.on('change', function () {
      $(this).text(selectedCurrency); // Update button text to the selected currency
      currencyDisplay.text(selectedCurrency);
      // currencyDisplay.text($(this).find('option:selected').text() || '--');
    });
    })(jQuery);
  </script>
@endpush -->