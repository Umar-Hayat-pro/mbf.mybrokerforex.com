@extends($activeTemplate . 'layouts.master')

@section('content')
<div class="row gy-4">
    <div class="col-12">
        <div class="dashboard-header-menu justify-content-between align-items-center">
            <h4 class="mb-0">{{ __($pageTitle) }}</h4>
        </div>
    </div>

    @if(session('warning'))
        <div class="alert alert-warning">
            {{ session('warning') }}
        </div>
    @endif


    <div class="row">
        <div class="col-sm-7 table-wrapper">
            <div class="card-body">
                <form action="{{ route('admin.accounttype.create') }}" method='POST'>
                    @csrf
                    <!-- <div class="form-group">
                        <label for="gtype">@lang('Account type')</label>
                        <div id="gtype">
                            <input type="radio" class="btn-check" name="groups" id="option1" value='real'
                                autocomplete="off">
                            <label class="btn btn--base outline btn--sm trade-btn mt-3" for="option1">Real</label>

                            <input type="radio" class="btn-check" name="groups" id="option2"
                                value="demo\MBFX\PREMIUM_200_USD_B" autocomplete="off">
                            <label class="btn btn--base outline btn--sm trade-btn mt-3" for="option2">Demo</label>
                        </div>
                    </div> -->

                    <div class="form-group">
                        <label for="gtype">@lang('Account type')</label>
                        <div id="gtype">
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <input type="radio" class="btn-check" name="groups" id="option1" value="real"
                                        autocomplete="off">
                                    <label class="nav-link  active" for="option1">@lang('Real')</label>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <input type="radio" class="btn-check" name="groups" id="option2"
                                        value="demo\MBFX\PREMIUM_200_USD_B" autocomplete="off">
                                    <label class="nav-link" for="option2">@lang('Demo')</label>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="group">@lang('Account Title')</label>
                        <input type="text" id="group" class="form-control" name="title" value="{{ $account->title }}"
                            readonly />
                    </div>

                    <div class="form-check form-switch form-group">
                        <input class="form-check-input" type="checkbox" name="swap_free" role="switch"
                            id="flexSwitchCheckDefault">
                        <label class="form-check-label"
                            for="flexSwitchCheckDefault">@lang('Request Swap-Free Option (Islamic Account)')</label>
                    </div>

                    <div class="form-group">
                        <label class="form-control-label">@lang('Leverage')</label>
                        <select style="font-size: 14px;" class="form-control" id="leverage" name="leverage" required>
                            @foreach (explode('/', $account['leverage']) as $leverage)
                                <option value="{{ $leverage }}">@lang(''){{ $leverage }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="fname">@lang('Account Nickname:')</label>
                        <input name='name' style="font-size: 14px;" type="text" class="form-control" id="name"
                            placeholder="Enter Nickname">
                    </div>

                    <div class="form-group">
                        <label for="password">@lang('Main Password:')</label>
                        <input style="font-size: 14px;" type="password" class="form-control" name="password"
                            id="password" placeholder="Enter Main Password">
                    </div>

                    <div class="form-group">
                        <span class="text-danger d-block" style="font-size: 10px;">
                            @lang('Use from 8 to 15 characters')
                        </span>
                        <span class="text-danger d-block" style="font-size: 10px;">
                            @lang('Use both uppercase and lowercase letters')
                        </span>
                        <span class="text-danger d-block" style="font-size: 10px;">
                            @lang('At least one number')
                        </span>
                        <span class="text-danger d-block" style="font-size: 10px;">
                            @lang('At least one special aracter(!@#$%^&*(),-.?":{}|<>)')
                        </span>
                    </div>

                    <div class="form-group mt-3">
                        <button class="btn btn-success" role="button">@lang('Create Account')</button>
                        <a href="{{ route('user.account-type-index') }}"
                            class="btn btn--danger btn--shadow btn-sm bal-btn" role="button">@lang('Cancel')</a>
                    </div>
            </div>
        </div>

        <div class="col-sm-5 mt-3 mt-sm-0">
            <h5 class="mb-3">Account Specifications and Features</h5>

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title ">Standard</h5>
                    <hr>

                    <div class="d-flex justify-content-between align-items-center form-group">
                        <p>Spread from:</p>
                        <span>{{ $account->spread }}</span>
                    </div>

                    <div class="d-flex justify-content-between align-items-center form-group">
                        <p>Commision:</p>
                        <span>{{ $account->commision }}</span>
                    </div>

                    <div class="d-flex justify-content-between align-items-center form-group">
                        <p>Leverage:</p>
                        <span id="selectedLeverage"></span>
                    </div>

                    <div class="d-flex justify-content-between align-items-center form-group">
                        <p>Initial Depost Limit:</p>
                        <span id="initial" name='initialbalance'
                            class="badge badge--success">${{ $account->initial_deposit }}</span>
                    </div>

                    <div class="form-group" style="display:none;">
                        <label for="initial_balance">@lang('Initial Balance')</label>
                        <input type="number" id="initial_balance" class="form-control" name="initial_balance" readonly
                            value="{{ $account->initial_deposit }}">
                    </div>

                </div>
            </div>
        </div>
        </form>

    </div>
    @endsection

    @push('script')
        <script>
            $(document).ready(function () {
                function updateSelectedLeverage() {
                    var leverage = $('#leverage').val();
                    $('#selectedLeverage').text(leverage);
                }

                updateSelectedLeverage();
                $('#leverage').on('change', updateSelectedLeverage);
            });
        </script>
    @endpush

    @push('script')
        <script>
            document.querySelectorAll('.nav-link').forEach((button) => {
                button.addEventListener('click', function () {
                    document.querySelectorAll('.nav-link').forEach((btn) => btn.classList.remove('active'));
                    this.classList.add('active');
                });
            });

        </script>

    @endpush