@extends($activeTemplate . 'layouts.master')
@section('content')
  <div class="row justify-content-start gy-4">
    <div class=" col-xxl-12 col-lg-12">
    <div class="row gy-3">
      @php
      $kycContent = getContent('kyc_content.content', true);

  @endphp
      @if ($user->kv == Status::KYC_UNVERIFIED && $user->kyc_rejection_reason)
      <div class="col-12">
      <div class="alert alert--danger skeleton" role="alert">
      <div class="flex-align justify-content-between">
      <h5 class="alert-heading text--danger mb-2">@lang('KYC Documents Rejected')</h5>
      <button data-bs-toggle="modal" data-bs-target="#kycRejectionReason">@lang('Show Reason')</button>
      </div>
      <p class="mb-0">
      {{ __(@$kycContent->data_values->rejection_content) }}
      <a href="{{ route('user.kyc.data') }}" class="text--base">@lang('See KYC Data')</a>
      </p>
      </div>
      </div>
    @endif
      @if ($user->kv == Status::KYC_UNVERIFIED)
      <div class="col-12">
      <div class="alert alert--danger skeleton" role="alert">
      <h5 class="alert-heading text--danger mb-2">@lang('KYC Verification Required')</h5>
      <p class="mb-0">
      {{ __(@$kycContent->data_values->unverified_content) }}
      @if ($user->kyc_rejection_reason)
      <br>
      <strong>@lang('Rejection Reason:')</strong> {{ $user->kyc_rejection_reason }}
    @endif
      <a href="{{ route('user.kyc.form') }}" class="text--base">@lang('Click here to verify')</a>
      </p>
      </div>
      </div>
    @endif
      @if ($user->kv == Status::KYC_PENDING)
      <div class="col-12">
      <div class="alert alert--warning flex-column justify-content-start align-items-start skeleton" role="alert">
      <h5 class="alert-heading text--warning mb-2">@lang('KYC Verification Pending')</h5>
      <p class="mb-0"> {{ __(@$kycContent->data_values->pending_content) }}
      <a href="{{ route('user.kyc.data') }}" class="text--base">@lang('See KYC Data')</a>
      </p>
      </div>
      </div>
    @endif

      @if ($user->profile_request == Status::REQUEST_PENDING)
      <div class="col-12">
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
      <i class="fas fa-exclamation-triangle me-2"></i>
      @lang('Your request is pending.')
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      </div>
    @endif

      @if ($user->profile_request == 3)
      <div class="col-12">
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <i class="fas fa-exclamation-triangle me-2"></i>
      @lang('Your request Has been rejected .')
      <p class="mb-0">{{ __($user->profile_request_reason) }}</p>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      </div>
    @endif


      @if ($user->profile_request == Status::REQUEST_APPROVE)
      <div class="col-12">
      <div class="alert alert-success alert-dismissible fade show" role="alert">
      <i class="fas fa-check-circle me-2"></i>
      @lang('Your request has been approved!')
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      </div>
    @endif



      @if (!$user->ts)
      <div class="col-12">
      <div class="alert-item 2fa-notice skeleton">
      <span class="delete-icon skeleton" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete">
      <i class="las la-times"></i></span>
      <div class="alert flex-align alert--danger remove-2fa-notice" role="alert">
      <span class="alert__icon">
        <i class="fas fa-exclamation"></i>
      </span>
      <div class="alert__content">
        <span class="alert__title">
        @lang('To secure your account add 2FA verification').
        <a href="{{ route('user.twofactor') }}" class="text--base text--small">@lang('Enable')</a>
        </span>
      </div>
      </div>
      </div>
      </div>
    @endif
    </div>
    <div class="dashboard-card-wrapper">
      <div class="row gy-4 mb-3 justify-content-center">
      <div class="col-xxl-3 col-sm-6">
        <div class="dashboard-card skeleton">
        <div class="d-flex justify-content-between align-items-center">
          <span class="dashboard-card__icon text--base">
          <i class="las la-spinner"></i>
          </span>
          <div class="dashboard-card__content">
          <a href="{{ route('user.order.open') }}" class="dashboard-card__coin-name mb-0 ">
            @lang('Open Order') </a>
          <h6 class="dashboard-card__coin-title"> {{ getAmount($widget['open_order']) }} </h6>
          </div>
        </div>
        </div>
      </div>
      <div class="col-xxl-3 col-sm-6">
        <div class="dashboard-card skeleton">
        <div class="d-flex justify-content-between align-items-center">
          <span class="dashboard-card__icon text--success">
          <i class="las la-check-circle"></i>
          </span>
          <div class="dashboard-card__content">
          <a href="{{ route('user.order.completed') }}" class="dashboard-card__coin-name mb-0">
            @lang('Completed Order') </a>
          <h6 class="dashboard-card__coin-title"> {{ getAmount($widget['completed_order']) }}
          </h6>
          </div>
        </div>
        </div>
      </div>
      <div class="col-xxl-3 col-sm-6">
        <div class="dashboard-card skeleton">
        <div class="d-flex justify-content-between align-items-center">
          <span class="dashboard-card__icon text--danger">
          <i class="las la-times-circle"></i>
          </span>
          <div class="dashboard-card__content">
          <a href="{{ route('user.order.canceled') }}" class="dashboard-card__coin-name mb-0 ">
            @lang('Canceled Order') </a>
          <h6 class="dashboard-card__coin-title"> {{ getAmount($widget['canceled_order']) }}
          </h6>
          </div>
        </div>
        </div>
      </div>
      <div class="col-xxl-3 col-sm-6">
        <div class="dashboard-card skeleton">
        <div class="d-flex justify-content-between align-items-center">
          <span class="dashboard-card__icon text--base">
          <span class="icon-trade fs-50"></span>
          </span>
          <div class="dashboard-card__content">
          <a href="{{ route('user.trade.history') }}" class="dashboard-card__coin-name mb-0">@lang('Total Trade')
          </a>
          <h6 class="dashboard-card__coin-title"> {{ getAmount($widget['total_trade']) }} </h6>
          </div>
        </div>
        </div>
      </div>

      </div>
      <div class="row gy-4 mb-3 justify-content-center">
      <div class="col-lg-6">
        <div class="transection h-100">
        <h5 class="transection__title skeleton"> @lang('Recent Order') </h5>
        @forelse ($recentOrders as $recentOrder)
      <div class="transection__item skeleton">
        <div class="d-flex flex-wrap align-items-center">
        <div class="transection__date">
        <h6 class="transection__date-number text-black">
        {{ showDateTime($recentOrder->created_at, 'd') }}
        </h6>
        <span class="transection__date-text">
        {{ __(strtoupper(showDateTime($recentOrder->created_at, 'M'))) }}
        </span>
        </div>
        <div class="transection__content">
        <h6 class="transection__content-title">
        @php echo $recentOrder->orderSideBadge; @endphp
        </h6>
        <p class="transection__content-desc">
        @lang('Placed an order in the ')
        {{ @$recentOrder->pair->symbol }} @lang('pair to')
        {{ __(strtolower(strip_tags($recentOrder->orderSideBadge))) }}
        {{ showAmount($recentOrder->amount) }}
        {{ @$recentOrder->pair->coin->symbol }}
        </p>
        </div>
        </div>
        @php echo $recentOrder->statusBadge; @endphp
      </div>
    @empty
    <div class="transection__item justify-content-center p-5 skeleton">
      <div class="empty-thumb text-center">
      <img src="{{ asset('assets/images/extra_images/empty.png') }}" />
      <p class="fs-14">@lang('No order found')</p>
      </div>
    </div>
  @endforelse
        </div>
      </div>
      <div class="col-lg-6">
        <div class="transection h-100">
        <h5 class="transection__title skeleton"> @lang('Recent Transactions') </h5>
        @forelse ($recentTransactions as $recentTransaction)
      <div class="transection__item skeleton">
        <div class="d-flex flex-wrap align-items-center">
        <div class="transection__date">
        <h6 class="transection__date-number text-black">
        {{ showDateTime($recentTransaction->created_at, 'd') }}
        </h6>
        <span class="transection__date-text">
        {{ __(strtoupper(showDateTime($recentTransaction->created_at, 'M'))) }}
        </span>
        </div>
        <div class="transection__content">
        <h6 class="transection__content-title">
        {{ __(ucwords(keyToTitle($recentTransaction->remark))) }}
        </h6>
        <p class="transection__content-desc">
        {{ __($recentTransaction->details) }}
        </p>
        </div>
        </div>
        @if ($recentTransaction->trx_type == '+')
      <span class="badge badge--success">
      @lang('Plus')
      </span>
    @else
    <span class="badge badge--danger">
    @lang('Minus')
    </span>
  @endif

      </div>
    @empty
    <div class="transection__item justify-content-center p-5 skeleton">
      <div class="empty-thumb text-center">
      <img src="{{ asset('assets/images/extra_images/empty.png') }}" />
      <p class="fs-14">@lang('No transactions found')</p>
      </div>
    </div>
  @endforelse
        </div>
      </div>
      </div>
    </div>
    </div>

    @if ($user->kv == Status::KYC_UNVERIFIED && $user->kyc_rejection_reason)
    <div class="modal fade custom--modal" id="kycRejectionReason">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
      <div class="modal-header"><i class="fas fa-ban"></i>
      <h5 class="modal-title">@lang('KYC Document Rejection Reason')</h5>
      <span type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
      <i class="las la-times"></i>
      </span>
      </div>
      <div class="modal-body text-center">
      <p>{{ auth()->user()->kyc_rejection_reason }}</p>
      </div>
      </div>
    </div>
    </div>
  @endif

  @endsection


  @push('topContent')
    <h4 class="mb-4">{{ __($pageTitle) }}</h4>
  @endpush
  @push('script')
    <script>
    $(document).on("click", ".delete-icon", function () {
      $(this).closest(".alert-item").fadeOut();
    });

    </script>
  @endpush