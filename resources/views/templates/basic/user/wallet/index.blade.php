@extends($activeTemplate . 'layouts.master')

@section('content')
  <div class="row gy-4">
    <!-- Header and Button Section -->
    <div class="col-12">
      <div class="dashboard-header-menu d-flex flex-column flex-sm-row justify-content-between">
        <h4 class="mb-4 mb-sm-0 me-sm-5">{{ __($pageTitle) }}</h4>
        <a href="{{ route('user.wallet.list', 'spot') }}" class="btn btn--base outline btn--sm trade-btn mt-2 mt-sm-0">
          <span class="icon-withdraw"></span> @lang('Manage Wallet')
        </a>
      </div>
    </div>

    <!-- Dashboard Card Section -->
    <div class="col-12 col-md-4 col-lg-8" >
      <div class="card  rounded-3">
        <div class="card-header bg-transparent d-flex justify-content-center align-items-center">
          <span class="mb-0 fs-18" style="color:black;">@lang('Available wallet balance including the converted total balance')</span>
        </div>
        <div class="card-body text-center">
          <h3 class="mb-0 pb-0 right-sidebar__number">
            {{ $general->cur_sym }}{{ showAmount($estimatedBalance) }}
          </h3>
          <span class="fs-14 mt-0"style="color:black;">@lang('Estimated Total Balance')</span>
        </div>
        <div class="card-footer  bg-transparent">
          <div class="wallet-wrapper">
            @forelse ($wallets as $wallet)
              <div class="d-flex align-items-center justify-content-between border p-3 rounded mb-3">
                <div class="d-flex align-items-center">
                  <span class="me-2">
                    <img src="{{ @$wallet->currency->image_url }}" alt="{{ @$wallet->currency->name }}" class="img-fluid"
                      style="width: 24px; height: 24px;">
                  </span>
                  <div>
                    <h6 class="mb-1"style="color:black;">
                      {{ strLimit(@$wallet->currency->name, 10) }}
                    </h6>
                    <span class="fs-11 d-block">
                      {{ @$wallet->currency->symbol }}
                    </span>
                  </div>
                </div>
                <h6 class="mb-0"> {{ showAmount($wallet->balance) }} </h6>
              </div>
            @empty
              <p class="text-center">@lang('No wallets available')</p>
            @endforelse
          </div>
          <button type="button" class="w-100 btn btn--base outline btn--sm mt-2 show-more-wallet">
            <span class="right-sidebar__button-icon">
              <i class="las la-chevron-circle-down"></i>@lang('Show More')
            </span>
          </button>
        </div>
      </div>
    </div>
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
    (function($) {
      let walletSkip = 3;

      $('.show-more-wallet').on('click', function(e) {
        let route = "{{ route('user.more.wallet', ':skip') }}";
        let $this = $(this);
        $.ajax({
          url: route.replace(':skip', walletSkip),
          type: "GET",
          dataType: 'json',
          cache: false,
          beforeSend: function() {
            $this.html(`
              <span class="right-sidebar__button-icon">
                <i class="las la-spinner la-spin"></i>
              </span>`).attr('disabled', true);
          },
          complete: function(e) {
            setTimeout(() => {
              $this.html(`
                <span class="right-sidebar__button-icon">
                  <i class="las la-chevron-circle-down"></i>
                </span>@lang('Show More')`).attr('disabled', false);
              $('.wallet-list').removeClass('skeleton');
            }, 500);
          },
          success: function(resp) {
            if (resp.success && (resp.wallets && resp.wallets.length > 0)) {
              let html = "";
              $.each(resp.wallets, function(i, wallet) {
                html += `
                  <div class="d-flex align-items-center justify-content-between border p-3 rounded mb-3">
                    <div class="d-flex align-items-center">
                      <span class="me-2">
                        <img src="${wallet.currency.image_url}" alt="${wallet.currency.name}" class="img-fluid" style="width: 24px; height: 24px;">
                      </span>
                      <div>
                        <h6 class="mb-1">
                          ${wallet.currency.name}
                        </h6>
                        <span class="fs-11 d-block">
                          ${wallet.currency.symbol}
                        </span>
                      </div>
                    </div>
                    <h6 class="mb-0">${getAmount(wallet.balance)}</h6>
                  </div>
                `;
              });
              walletSkip += 3;
              $('.wallet-wrapper').append(html);
            } else {
              $this.remove();
            }

            $('.card-footer').animate({
              scrollTop: $('.card-footer')[0].scrollHeight + 150
            }, "slow");
          },
          error: function() {
            notify('error', "@lang('Something went wrong')");
            $this.remove();
          }
        });
      });

    })(jQuery);
  </script>
@endpush
