@extends($activeTemplate . 'layouts.master')

@section('content')
<div class="row justify-content-center gy-4">
    <div class="col-12">
        <div class="dashboard-header-menu justify-content-between align-items-center">
            <h4 class="mb-0">{{ __($pageTitle) }}</h4>
        </div>
    </div>
    <div class="col-xxl-9 col-lg-12">
        <div class="row gy-3">
            <div class="dashboard-card-wrapper">
                <div class="row gy-4 mb-3 justify-content-center">
                    {{-- IB Balance --}}
                    <div class="col-xxl-4 col-sm-6">
                        <div class="dashboard-card skeleton">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="dashboard-card__icon text--base">
                                    <i class="las la-money-bill"></i>
                                </span>
                                <div class="dashboard-card__content">
                                    <a {{-- href="{{ route('user.order.open') }}" --}}
                                        class="dashboard-card__coin-name mb-0">
                                        @lang('MIB Balance')
                                    </a>
                                    <h6 class="dashboard-card__coin-title">
                                        @if ($ib_accounts->isNotEmpty())
                                            {{ getAmount($ib_accounts->first()->Balance) }}
                                        @else
                                            0
                                        @endif

                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- IB Amount --}}
                    <div class="col-xxl-4 col-sm-6">
                        <div class="dashboard-card skeleton">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="dashboard-card__icon text--success">
                                    <i class="las la-balance-scale-left"></i>
                                </span>
                                <div class="dashboard-card__content">
                                    <a {{-- href="{{ route('user.order.completed') }}" --}}
                                        class="dashboard-card__coin-name mb-0">
                                        @lang('MIB Amount')
                                    </a>
                                    <h6 class="dashboard-card__coin-title">
                                        {{ getAmount($ibAmount) }}
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- MIB Overview --}}
                    <div class="col-xxl-4 col-sm-6">
                        <div class="dashboard-card skeleton">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="dashboard-card__icon text--warning">
                                    <i class="las la-wallet"></i>
                                </span>
                                <div class="dashboard-card__content">
                                    <a {{-- href="{{ route('user.wallet') }}" --}}
                                        class="dashboard-card__coin-name mb-0">
                                        @lang('MIB Overview')
                                    </a>
                                    <h6 class="dashboard-card__coin-title">
                                        {{ getAmount($mibBalance) }}
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Referral URL and Tree Section --}}
                <div class="row gy-4 mb-3 justify-content-start">
                    <div class="col-lg-12">
                        <div class="transection h-100">
                            <h5 class="mb-2 ">@lang('Referral URL and Tree')</h5>
                            <div class="copy-link p-3 mb-3 rounded-3">
                                <input type="text" class="col-lg-10 copyText p-3 border-0"
                                    value="{{ route('home') }}?reference={{ $user->username }}" readonly>
                                <button class="copy-link__button copyTextBtn" data-bs-toggle="tooltip"
                                    data-bs-placement="right" title="@lang('Copy URL')">
                                    <span class="copy-link__icon"><i class="las la-copy" style="font-size: 24px;"></i>
                                    </span>
                                </button>
                            </div>

                            {{-- Referral Tree --}}
                            @if ($user->referrer)
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4>@lang('You are referred by') <span
                                                    class="text--base">{{ @$user->referrer->fullname }}</span></h4>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="col-md-12">
                                @if ($user->allReferrals->count() > 0 && ($maxLevel ?? 0) > 0)
                                                                <div class="card">
                                                                    <div class="card-header">
                                                                        <h5 class="text-start">@lang('Users Referred By Me')</h5>
                                                                    </div>
                                                                    <div class="card-body">
                                                                        <div class="treeview-container">
                                                                            <ul class="treeview">
                                                                                <li class="items-expanded">{{ $user->fullname }} ({{ $user->username }})
                                                                                    @include($activeTemplate . 'partials.under_tree', [
                                        'user' => $user,
                                        'layer' => 0,
                                        'isFirst' => true,
                                    ])
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                @else
                                    <div class="card">
                                        <div class="card-body p-5">
                                            <div class="empty-thumb text-center">
                                                <img src="{{ asset('assets/images/extra_images/empty.png') }}" />
                                                <p class="fs-14">@lang('No data found')</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                {{-- End of Referral URL and Tree Section --}}

            </div>
        </div>
    </div>

    <div class="col-10 col-sm-8 col-md-6 col-lg-3">
        <div class="card rounded-3">
            <div class="card-header d-flex flex-column align-items-center bg-transparent">
                <div class="right-sidebar__header mb-3 text-center">
                    <div class="d-flex flex-column flex-md-row justify-content-center">
                        <div class="text-center mb-3 mb-md-0">
                            <h4 class="dashboard-card__coin-title text--base">
                                {{ getAmount($mibBalance) ?? 0 }}
                            </h4>
                            <span class="mb-0 fs-18" style="color:black;">@lang('Withdraw Earnings')</span>
                        </div>
                        {{-- <span class="toggle-dashboard-right dashboard--popup-close d-md-none"><i
                                class="las la-times"></i></span> --}}
                    </div>
                </div>

                <div class="w-100">
                    <div class="form-group">
                        <label class="fs-14 mb-1" style="color:black;">@lang('Amount')</label>
                        <input class="form-control" type="number" placeholder="@lang('Enter Amount')" />
                    </div>

                    <div class="form-group">
                        <label class="fs-14 mb-1" style="color:black;">@lang('Payment Method')</label>
                        <select class="form-control" name="method">
                            <option value="Select">Select</option>
                            {{-- @foreach ($depositMethods as $depositMethod)
                            <option value="{{ $depositMethod->id }}">{{ __($depositMethod->name) }}</option>
                            @endforeach --}}
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="fs-14 mb-1" style="color:black;">@lang('MT5 Account')</label>
                        <select class="form-control" name="method">
                            <option value="Select">Select</option>
                            @forelse ($ib_accounts as $account)
                                <option value="{{ $account->Login }}">{{ $account->Login }}</option>
                            @empty
                                <option value="" disabled>No MT5 accounts found</option>
                            @endforelse
                        </select>
                    </div>
                </div>
            </div>
            {{-- Additional right sidebar content can go here --}}
        </div>
    </div>


    {{-- JavaScript to copy referral URL --}}
    {{--
    <script>
        function copyReferralUrl() {
            const referralUrl = document.getElementById('referralUrl');
            referralUrl.select();
            referralUrl.setSelectionRange(0, 99999);
            document.execCommand('copy');
            alert("@lang('Referral URL copied to clipboard!')");
        }
    </script> --}}
    @endsection