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

                        <div class="form-group">
                            <label for="gtype">@lang('Account type')</label>
                            <div id="gtype">
                                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <input type="radio" class="btn-check" name="groups" id="option1" value="real"
                                            autocomplete="off" checked>
                                        <label class="nav-link active" for="option1">@lang('Real')</label>
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
                        <div class="form-group" id="initial_balance_field" style="display: none;">
                            <label for="initial_balance">@lang('Initial Balance')</label>
                            <select class="form-control" id="initial_balance" name="initial_balance">
                                <option value="1000">1000</option>
                                <option value="5000">5000</option>
                                <option value="10000">10000</option>
                            </select>
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

            $(document).ready(function () {
                $(".nav-link").on("click", function () {
                    $(".nav-link").removeClass("active"); // Remove active class from all buttons
                    $(this).addClass("active"); // Add active class to the clicked button
                });
            });

            $(document).ready(function () {
                $('input[name="groups"]').change(function () {
                    if ($('#option2').is(':checked')) {
                        $('#initial_balance').attr('name', 'initial_balance'); // Add name attribute (send value)
                        $('#initial_balance_field').slideDown();
                    } else {
                        $('#initial_balance').removeAttr('name'); // Remove name attribute (do not send value)
                        $('#initial_balance_field').slideUp();
                    }
                });

                // Run on page load to ensure correct state
                if (!$('#option2').is(':checked')) {
                    $('#initial_balance').removeAttr('name');
                }
            });

            $(document).ready(function () {
                const passwordInput = $("#password");

                // Password validation criteria
                const lengthCriteria = /.{8,15}/;
                const uppercaseLowercaseCriteria = /^(?=.*[a-z])(?=.*[A-Z])/;
                const numberCriteria = /(?=.*\d)/;

                passwordInput.on("input", function () {
                    const password = $(this).val();

                    // Update validation messages
                    validateCriterion(password, lengthCriteria, "Use from 8 to 15 characters");
                    validateCriterion(password, uppercaseLowercaseCriteria, "Use both uppercase and lowercase letters");
                    validateCriterion(password, numberCriteria, "At least one number");
                });

                function validateCriterion(password, regex, message) {
                    const targetSpan = $(`span:contains('${message}')`);
                    if (regex.test(password)) {
                        targetSpan.removeClass("text-danger").addClass("text-success");
                    } else {
                        targetSpan.removeClass("text-success").addClass("text-danger");
                    }
                }
            });


        </script>
    @endpush