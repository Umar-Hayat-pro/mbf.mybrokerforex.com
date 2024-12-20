@extends($activeTemplate . 'layouts.master')

@section('content')
<div class="row gy-4">
    <div class="col-12">
        <div class="dashboard-header-menu justify-content-between align-items-center">
            <h4 class="mb-0">{{ __($pageTitle) }}</h4>
        </div>
    </div>

    <!-- Real / Demo Accounts Tabs -->
    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="real-tab" data-bs-toggle="pill" data-bs-target="#real-tab-pane"
                type="button" role="tab" aria-controls="real-tab-pane" aria-selected="true">@lang('Real')</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="demo-tab" data-bs-toggle="pill" data-bs-target="#demo-tab-pane" type="button"
                role="tab" aria-controls="demo-tab-pane" aria-selected="false">@lang('Demo')</button>
        </li>
    </ul>

    <div class="tab-content" id="pills-tabContent">
        <!-- Real Accounts Tab -->
        <div class="tab-pane fade show active" id="real-tab-pane" role="tabpanel" aria-labelledby="real-tab">
            <div class="row gy-4">
                @forelse($real as $real_acc)
                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                        <div class="card rounded-10 shadow-sm text-center flex-fill">
                            <div class="card-body d-flex flex-column justify-content-between">

                                <header class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="text-start m-0" style="font-size:13px;">{{ $real_acc->Name }}</h5>
                                    <div class="dropdown">
                                        <button class="btn btn-link p-0 text-dark" type="button" id="dropdownMenuButton"
                                            data-bs-toggle="dropdown" aria-expanded="false"
                                            style="font-size: 1.2rem; text-decoration:none; position: relative; top: -5px;">
                                            ...
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end p-3" aria-labelledby="dropdownMenuButton"
                                            style="width: 250px;">
                                            <div class="d-flex justify-content-around text-center gap-3">
                                                <div class="icon-container" data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Deposit">
                                                    <a class="dropdown-item p-0" href="{{ route('user.deposit') }}">
                                                        <div class="icon mb-1">
                                                            <span class="icon-deposit" style="font-size: 1.2rem;"></span>
                                                        </div>
                                                        <small style="font-size: 10px;">@lang('Deposit')</small>
                                                    </a>
                                                </div>
                                                <div class="icon-container" data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Withdraw">
                                                    <a class="dropdown-item p-0" href="{{ route('user.withdraw') }}">
                                                        <div class="icon mb-1">
                                                            <span class="icon-withdraw" style="font-size: 1.2rem;"></span>
                                                        </div>
                                                        <small style="font-size: 10px;">@lang('Withdraw')</small>
                                                    </a>
                                                </div>
                                                <div class="icon-container" data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Trade History">
                                                    <a class="dropdown-item p-0" href="{{ route('user.trade.history') }}">
                                                        <div class="icon mb-1">
                                                            <span class="icon-trade" style="font-size: 1.2rem;"></span>
                                                        </div>
                                                        <small style="font-size: 10px;">@lang('Trade')</small>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="dropdown-divider mt-3 mb-1" style="border-top: 1px solid grey;">
                                            </div>
                                            <li class="dropdown-item" style="font-size: 12px; margin-top: 10px;">
                                                <a href="#" style="text-decoration: none; color: inherit;">
                                                    @lang('Account Details')</a>
                                            </li>
                                            <div class="dropdown-divider my-2" style="border-top: 1px solid grey;"></div>
                                            <li class="dropdown-item" style="font-size: 12px;">
                                                <a href="#" style="text-decoration: none; color: inherit;">
                                                    @lang('Change Leverage')</a>
                                            </li>
                                            <div class="dropdown-divider my-2" style="border-top: 1px solid grey;"></div>
                                            <li class="dropdown-item" style="font-size: 12px;">
                                                <a href="#" style="text-decoration: none; color: inherit;">
                                                    @lang('Rename Account')</a>
                                            </li>
                                        </ul>
                                    </div>
                                </header>

                                <div class="account-details table">
                                    <div class="d-flex justify-content-between py-3"
                                        style="border-top: 1px solid rgb(235, 235, 235);">
                                        <span>@lang('Account Number:')</span>
                                        <span>{{ $real_acc->Login }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between py-3"
                                        style="border-top: 1px solid rgb(235, 235, 235);">
                                        <span>@lang('Leverage:')</span>
                                        <span>{{ $real_acc->Leverage }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between py-3"
                                        style="border-top: 1px solid rgb(235, 235, 235);">
                                        <span>@lang('Equity:')</span>
                                        <span>{{ $real_acc->EquityPrevDay }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between py-3"
                                        style="border-top: 1px solid rgb(235, 235, 235);">
                                        <span>@lang('Balance:')</span>
                                        <span>{{ $real_acc->Balance }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p class="text-muted">{{ __($emptyMessage) }}</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Demo Accounts Tab -->
        <div class="tab-pane fade" id="demo-tab-pane" role="tabpanel" aria-labelledby="demo-tab">
            <div class="row gy-4">
                @forelse($demo as $acc)
                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                        <div class="card rounded-10 shadow-sm text-center flex-fill">
                            <div class="card-body d-flex flex-column justify-content-between">
                                <header class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="text-start m-0" style="font-size:13px;">{{ $acc->Name }}</h5>
                                    <span class="badge badge--success" style="font-size:13px">{{ $acc->Status }}</span>
                                </header>
                                <div class="account-details table">
                                    <div class="d-flex justify-content-between py-3"
                                        style="border-top: 1px solid rgb(235, 235, 235);">
                                        <span>@lang('Account Number:')</span>
                                        <span>{{ $acc->Login }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between py-3"
                                        style="border-top: 1px solid rgb(235, 235, 235);">
                                        <span>@lang('Leverage:')</span>
                                        <span>{{ $acc->Leverage }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between py-3"
                                        style="border-top: 1px solid rgb(235, 235, 235);">
                                        <span>@lang('Equity:')</span>
                                        <span>{{ $acc->EquityPrevDay }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between py-3"
                                        style="border-top: 1px solid rgb(235, 235, 235);">
                                        <span>@lang('Balance:')</span>
                                        <span>{{ $acc->Balance }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p class="text-muted">{{ __($emptyMessage) }}</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection