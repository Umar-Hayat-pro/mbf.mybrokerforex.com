@extends($activeTemplate . 'layouts.master')

@section('content')
<div class="row gy-4 justify-content-between">
  <div class="col-12">
    <div class="flex-sm-row flex-column dashboard-header-menu d-flex justify-content-between">
      <h4 class="mb-0">{{ __($pageTitle) }}</h4>
      <a href="{{ route('user.withdraw.history') }}" class="btn btn--base outline btn--sm trade-btn">
        <span class="icon-withdraw"></span> @lang('Withdraw')
      </a>
    </div>
  </div>

  <div class="right-sidebar mt-3 col-12 col-md-4 col-lg-8 card ">
    <div class="card-header justify-content-center  bg-transparent d-flex  right-sidebar__header mb-3 skeleton">
      <span class="mb-0 fs-18"
        style="color:#000">@lang('Withdrawal your balance with our world-class withdrawal process')</span>
    </div>
    <div class="right-sidebar__deposit">
      <form class="skeleton withdraw-form">
        <div class="form-group position-relative" id="withdraw_currency_list_wrapper">
          <div class="input-group">
            <input type="number" name="amount" step="any" class="form-control form--control2"
              placeholder="@lang('Amount')" value="{{ old('amount', $amount ?? '') }}">
            <div class="input-group-text skeleton">
              <x-currency-list :action="route('user.currency.all')" id="withdraw_currency_list"
                parent="withdraw_currency_list_wrapper" valueType="2" logCurrency="true" />
            </div>
          </div>
        </div>
        <button class="deposit__button btn btn--base w-100" type="submit">
          <span class="icon-withdraw"></span> @lang('Withdraw')
        </button>
      </form>
    </div>
  </div>
  <x-flexible-view :view="$activeTemplate . 'user.components.canvas.withdraw'" :meta="['withdrawMethods' => $withdrawMethods]" />
</div>
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
    // JavaScript code specific to withdraw functionality
    $('.2fa-notice').on('click', '.delete-icon', function (e) {
      $(this).closest('.col-12').fadeOut('slow', function () {
      $(this).remove();
      });
    });

    let walletSkip = 3;

    $('.show-more-wallet').on('click', function (e) {
      let route = "{{ route('user.more.wallet', ':skip') }}";
      let $this = $(this);
      $.ajax({
      url: route.replace(':skip', walletSkip),
      type: "GET",
      dataType: 'json',
      cache: false,
      beforeSend: function () {
        $this.html(`
      <span class="right-sidebar__button-icon">
      <i class="las la-spinner la-spin"></i>
      </span>`).attr('disabled', true);
      },
      complete: function (e) {
        setTimeout(() => {
        $this.html(`
      <span class="right-sidebar__button-icon">
      <i class="las la-chevron-circle-down"></i>
      </span>@lang('Show More')`).attr('disabled', false);
        $('.wallet-list').removeClass('skeleton');
        }, 500);
      },
      success: function (resp) {
        if (resp.success && (resp.wallets && resp.wallets.length > 0)) {
        let html = "";
        $.each(resp.wallets, function (i, wallet) {
          html += `
      <div class="right-sidebar__item wallet-list skeleton">
      <div class="d-flex align-items-center">
      <span class="right-sidebar__item-icon">
      <img src="${wallet.currency.image_url}">
      </span>
      <h6 class="right-sidebar__item-name">
      ${wallet.currency.name}
      <span class="fs-11 d-block">
      ${wallet.currency.symbol}
      </span>
      </h6>
      </div>

      <h6 class="right-sidebar__item-number">${getAmount(wallet.balance)}</h6>
      </div>
      `
        });
        walletSkip += 3;
        $('.wallet-wrapper').append(html);
        } else {
        $this.remove();
        }

        $('.right-sidebar__menu').animate({
        scrollTop: $('.right-sidebar__menu')[0].scrollHeight + 150
        }, "slow");
      },
      error: function () {
        notify('error', "@lang('Something went wrong')");
        $this.remove();
      }
      });
    });

    })(jQuery);
  </script>
@endpush