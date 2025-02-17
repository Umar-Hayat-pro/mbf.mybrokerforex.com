@extends('admin.layouts.app')
@section('panel')
  <div class="row">

    <div class="col-12">
    <div class="row gy-4">
      <div class="col-xxl-3 col-sm-6">
      <div class="widget-two style--two box--shadow2 b-radius--5 bg--19">
        <div class="widget-two__icon b-radius--5 bg--primary">
        <i class="las la-money-bill-wave-alt"></i>
        </div>
        <div class="widget-two__content">
        <h3 class="text-white">{{ getAmount($widget['total_trade']) }}</h3>
        <p class="text-white">@lang('Total Order')</p>
        </div>
        <a href="{{ route('admin.order.history') }}?user_id={{ $user->id }}"
        class="widget-two__btn">@lang('View All')</a>
      </div>
      </div>
      <div class="col-xxl-3 col-sm-6">
      <div class="widget-two style--two box--shadow2 b-radius--5 bg--primary">
        <div class="widget-two__icon b-radius--5 bg--primary">
        <i class="las la-wallet"></i>
        </div>
        <div class="widget-two__content">
        <h3 class="text-white">{{ getAmount($widget['total_trade']) }}</h3>
        <p class="text-white">@lang('Total Trade')</p>
        </div>
        <a href="{{ route('admin.trade.history') }}?trader_id={{ $user->id }}"
        class="widget-two__btn">@lang('View All')</a>
      </div>
      </div>
      <div class="col-xxl-3 col-sm-6">
      <div class="widget-two style--two box--shadow2 b-radius--5 bg--1">
        <div class="widget-two__icon b-radius--5 bg--primary">
        <i class="fas fa-wallet"></i>
        </div>
        <div class="widget-two__content">
        <h3 class="text-white">{{ getAmount($widget['total_deposit']) }}</h3>
        <p class="text-white">@lang('Total Deposit')</p>
        </div>
        <a href="{{ route('admin.deposit.list') }}?search={{ $user->username }}"
        class="widget-two__btn">@lang('View All')</a>
      </div>
      </div>
      <div class="col-xxl-3 col-sm-6">
      <div class="widget-two style--two box--shadow2 b-radius--5 bg--17">
        <div class="widget-two__icon b-radius--5 bg--primary">
        <i class="las la-exchange-alt"></i>
        </div>
        <div class="widget-two__content">
        <h3 class="text-white">{{ getAmount($widget['total_transaction']) }}</h3>
        <p class="text-white">@lang('Transactions')</p>
        </div>
        <a href="{{ route('admin.report.transaction') }}?search={{ $user->username }}"
        class="widget-two__btn">@lang('View All')</a>
      </div>
      </div>
    </div>

    <div class="d-flex flex-wrap gap-3 mt-4">
      <div class="flex-fill">
      <button data-bs-toggle="modal" data-bs-target="#addSubModal"
        class="btn btn--success btn--shadow w-100 btn-lg bal-btn" data-act="add">
        <i class="las la-plus-circle"></i> @lang('Balance')
      </button>
      </div>

      <div class="flex-fill">
      <button data-bs-toggle="modal" data-bs-target="#addSubModal"
        class="btn btn--danger btn--shadow w-100 btn-lg bal-btn" data-act="sub">
        <i class="las la-minus-circle"></i> @lang('Balance')
      </button>
      </div>

      <div class="flex-fill">
      <a href="{{ route('admin.report.login.history') }}?search={{ $user->username }}"
        class="btn btn--primary btn--shadow w-100 btn-lg">
        <i class="las la-list-alt"></i>@lang('Logins')
      </a>
      </div>

      <div class="flex-fill">
      <a href="{{ route('admin.users.notification.log', $user->id) }}"
        class="btn btn--secondary btn--shadow w-100 btn-lg">
        <i class="las la-bell"></i>@lang('Notifications')
      </a>
      </div>

      <div class="flex-fill">
      <a href="{{ route('admin.users.login', $user->id) }}" target="_blank"
        class="btn btn--primary btn--gradi btn--shadow w-100 btn-lg">
        <i class="las la-sign-in-alt"></i>@lang('Login as User')
      </a>
      </div>


      @if ($user->kyc_data)
      <div class="flex-fill">
      <a href="{{ route('admin.users.kyc.details', $user->id) }}" target="_blank"
      class="btn btn--dark btn--shadow w-100 btn-lg">
      <i class="las la-user-check"></i>@lang('KYC Data')
      </a>
      </div>
    @endif

      <div class="flex-fill">
      @if ($user->status == Status::USER_ACTIVE)
      <button type="button" class="btn btn--warning btn--gradi btn--shadow w-100 btn-lg userStatus"
      data-bs-toggle="modal" data-bs-target="#userStatusModal">
      <i class="las la-ban"></i>@lang('Ban User')
      </button>
    @else
      <button type="button" class="btn btn--success btn--gradi btn--shadow w-100 btn-lg userStatus"
      data-bs-toggle="modal" data-bs-target="#userStatusModal">
      <i class="las la-undo"></i>@lang('Unban User')
      </button>
    @endif
      </div>
    </div>

    <div class="flex">
      <ul class="nav nav-tabs mt-2">
      <li class="nav-item">
        <a href="#overview-tab-pane" class="nav-link active" data-bs-toggle="tab" role="tab"
        aria-controls="overview-tab-pane" aria-selected="true">
        <span class="menu-title">@lang('Overview')</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="#account-tab-pane" class="nav-link" data-bs-toggle="tab" role="tab" aria-controls="account-tab-pane"
        aria-selected="false">
        <span class="menu-title">@lang('Account')</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="#partner-tab-pane" class="nav-link" data-bs-toggle="tab" role="tab" aria-controls="partner-tab-pane"
        aria-selected="false">
        <span class="menu-title">@lang('Partner')</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="#transaction-tab-pane" class="nav-link" data-bs-toggle="tab" role="tab"
        aria-controls="transaction-tab-pane" aria-selected="false">
        <span class="menu-title">@lang('Transaction')</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="#referals-tab-pane" class="nav-link" data-bs-toggle="tab" role="tab"
        aria-controls="referals-tab-pane" aria-selected="false">
        <span class="menu-title">@lang('Direct Referrals')</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="#network-tab-pane" class="nav-link" data-bs-toggle="tab" role="tab" aria-controls="network-tab-pane"
        aria-selected="false">
        <span class="menu-title">@lang('Network')</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="#tickets-tab-pane" class="nav-link" data-bs-toggle="tab" role="tab" aria-controls="tickets-tab-pane"
        aria-selected="false">
        <span class="menu-title">@lang('TIckets')</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="#note-tab-pane" class="nav-link" data-bs-toggle="tab" role="tab" aria-controls="note-tab-pane"
        aria-selected="false">
        <span class="menu-title">@lang('Add Note')</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="#security-tab-pane" class="nav-link" data-bs-toggle="tab" role="tab"
        aria-controls="security-tab-pane" aria-selected="false">
        <span class="menu-title">@lang('Security')</span>
        </a>
      </li>
      </ul>

      <div class="tab-content mt-3">
      <div class="tab-pane fade show active" id="overview-tab-pane" role="tabpanel" aria-labelledby="overview-tab">
        <x-user-detail.detail :user="$user" :countries="$countries" />
      </div>
      <div class="tab-pane fade" id="account-tab-pane" role="tabpanel" aria-labelledby="account-tab">
        <x-user-detail.account :user="$user" :accounts="$accounts" :countries="$countries" />
      </div>
      <div class="tab-pane fade" id="partner-tab-pane" role="tabpanel" aria-labelledby="partner-tab">
        <x-user-detail.partner :user="$user" :ibaccount="$ib_accounts" />
      </div>
      <div class="tab-pane fade" id="transaction-tab-pane" role="tabpanel" aria-labelledby="transaction-tab">
        <x-user-detail.transaction :user="$user" />
      </div>
      <div class="tab-pane fade" id="referals-tab-pane" role="tabpanel" aria-labelledby="referals-tab">
        <x-user-detail.referral :user='$user' />
      </div>
      <div class="tab-pane fade" id="network-tab-pane" role="tabpanel" aria-labelledby="network-tab">
        <x-user-detail.network :user='$user' />
      </div>
      <div class="tab-pane fade" id="tickets-tab-pane" role="tabpanel" aria-labelledby="tickets-tab">
        <x-user-detail.tickets :user='$user' />
      </div>
      <div class="tab-pane fade" id="note-tab-pane" role="tabpanel" aria-labelledby="note-tab">
        <x-user-detail.note :user='$user' />
      </div>
      <div class="tab-pane fade" id="security-tab-pane" role="tabpanel" aria-labelledby="security-tab">
        <x-user-detail.security />
      </div>
      </div>
    </div>
    </div>
    <div class="row mt-3 gy-3">
    <div class="col-12">
      <h6>@lang('User Wallet Balance')</h6>
    </div>
    @forelse ($user->wallets->where('balance', ">", 0)->sortByDesc('balance') as $wallet)
    <div class="col-xxl-3 col-sm-6">
      <div class="widget-two box--shadow2 b-radius--5 bg--white">
      <div class="widget-two__icon b-radius--5">
      <img src="{{ @$wallet->currency->image_url }}">
      </div>
      <div class="widget-two__content">
      <h3>{{ showAmount($wallet->balance) }} {{ @$wallet->currency->symbol }}</h3>
      <p>@lang('Total Balance')</p>
      @if (Status::WALLET_TYPE_SPOT == $wallet->wallet_type)
      <span class="badge badge--primary">
      @lang('SPOT')
      </span>
    @else
      <span class="badge badge--success">
      @lang('FUNDING')
      </span>
    @endif
      </div>
      </div>
    </div>
  @empty
  <div class="col-12 text-center">
    <div class="card">
    <div class="card-body">
    <h6>@lang("This user haven't any wallet balance")</h6>
    </div>
    </div>
  </div>
@endforelse
    </div>
  </div>
  </div>

  {{-- Add Sub Balance MODAL --}}
  <div id="addSubModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title"><span class="type"></span> <span>@lang('Balance')</span></h5>
      <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
        <i class="las la-times"></i>
      </button>
      </div>
      <form action="{{ route('admin.users.add.sub.balance', $user->id) }}" method="POST">
      @csrf
      <input type="hidden" name="act">
      <div class="modal-body">
        <div class="form-group position-relative">
        <label>@lang('Wallet')</label>
        <select name="wallet" class="form-control select2" required>
          <option value="" disabled selected>@lang('Select One')</option>
          @foreach ($currencies as $currency)
        <option value="{{ $currency->id }}" data-symbol="{{ $currency->symbol }}">{{ $currency->symbol }}
        </option>
      @endforeach
        </select>
        </div>
        <div class="form-group">
        <label>@lang('Wallet Type')</label>
        <select class="form-control" name="wallet_type" required>
          <option selected disabled>@lang('Select One')</option>
          @foreach (gs('wallet_types') as $wallet)
        <option value="{{ $wallet->name }}">{{ __($wallet->title) }}</option>
      @endforeach
        </select>
        </div>
        <div class="form-group">
        <label>@lang('Amount')</label>
        <div class="input-group">
          <input type="number" step="any" name="amount" class="form-control"
          placeholder="@lang('Please provide positive amount')" required>
          <div class="input-group-text wallet-cur-symbol">{{ __($general->cur_text) }}</div>
        </div>
        </div>
        <div class="form-group">
        <label>@lang('Remark')</label>
        <textarea class="form-control" placeholder="@lang('Remark')" name="remark" rows="4" required></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn--primary h-45 w-100">@lang('Submit')</button>
      </div>
      </form>
    </div>
    </div>
  </div>


  <div id="userStatusModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title">
        @if ($user->status == Status::USER_ACTIVE)
      <span>@lang('Ban User')</span>
    @else
    <span>@lang('Unban User')</span>
  @endif
      </h5>
      <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
        <i class="las la-times"></i>
      </button>
      </div>
      <form action="{{ route('admin.users.status', $user->id) }}" method="POST">
      @csrf
      <div class="modal-body">
        @if ($user->status == Status::USER_ACTIVE)
      <h6 class="mb-2">@lang('If you ban this user he/she won\'t able to access his/her dashboard.')</h6>
      <div class="form-group">
      <label>@lang('Reason')</label>
      <textarea class="form-control" name="reason" rows="4" required></textarea>
      </div>
    @else
    <p><span>@lang('Ban reason was'):</span></p>
    <p>{{ $user->ban_reason }}</p>
    <h4 class="text-center mt-3">@lang('Are you sure to unban this user?')</h4>
  @endif
      </div>
      <div class="modal-footer">
        @if ($user->status == Status::USER_ACTIVE)
      <button type="submit" class="btn btn--primary h-45 w-100">@lang('Submit')</button>
    @else
    <button type="button" class="btn btn--dark" data-bs-dismiss="modal">@lang('No')</button>
    <button type="submit" class="btn btn--primary">@lang('Yes')</button>
  @endif
      </div>
      </form>
    </div>
    </div>
  </div>
@endsection

@push('script')
  <script>
    (function ($) {
    "use strict"
    $('.bal-btn').click(function () {
      var act = $(this).data('act');
      $('#addSubModal').find('input[name=act]').val(act);
      if (act == 'add') {
      $('.type').text('Add');
      } else {
      $('.type').text('Subtract');
      }
    });

    let mobileElement = $('.mobile-code');

    $('select[name=country]').change(function () {
      mobileElement.text(`+${$('select[name=country] :selected').data('mobile_code')}`);
    });

    $('select[name=country]').val('{{ @$user->country_code }}');

    let dialCode = $('select[name=country] :selected').data('mobile_code');
    let mobileNumber = `{{ $user->mobile }}`;

    mobileNumber = mobileNumber.replace(dialCode, '');
    $('input[name=mobile]').val(mobileNumber);
    mobileElement.text(`+${dialCode}`);

    $('select[name=wallet]').on('change', function (e) {
      let symbol = $(this).find('option:selected').data('symbol');
      $(`.wallet-cur-symbol`).text(symbol);
    });

    $('.select2').select2({
      dropdownParent: $(`.position-relative`)
    });
    })(jQuery);
  </script>
@endpush