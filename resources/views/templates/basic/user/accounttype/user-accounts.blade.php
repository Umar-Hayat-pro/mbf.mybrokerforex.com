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
                        <!-- Leverage Change Modal for Demo Accounts -->
                        <div class="modal fade" id="leverageModal-{{ $real_acc->Login }}" tabindex="-1"
                            aria-labelledby="leverageModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="leverageModalLabel">@lang('Change Leverage')</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="leverageForm-{{ $real_acc->Login }}"
                                            action="{{-- route('user.change.leverage') --}}" method="POST">
                                            @csrf
                                            <input type="hidden" name="account_id" value="{{ $real_acc->Login }}">
                                            <span>{{ $real_acc->Login }}</span>
                                            <div class="mb-3">
                                                <label for="leverage" class="form-label">@lang('Select Leverage')</label>
                                                <select class="form-select" name="leverage" id="leverage">
                                                    <option value="100">100</option>
                                                    <option value="200">200</option>
                                                    <option value="300">300</option>
                                                    <option value="400">400</option>
                                                    <option value="500">500</option>
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-primary">@lang('Update Leverage')</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Model ends here for real accounts --}}
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
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#leverageModal-{{ $real_acc->Login }}"
                                                        style="text-decoration: none; color: inherit;">
                                                        @lang('Change Leverage')
                                                    </a>
                                                </li>

                                                <div class="dropdown-divider my-2" style="border-top: 1px solid grey;"></div>
                                                <li class="dropdown-item" style="font-size: 12px;">
                                                    <a href="#" style="text-decoration: none; color: inherit;">
                                                        @lang('Rename Account')</a>
                                                </li>
                                                <!-- ✅ Show/Hide Master Password Section -->
                                                <div class="dropdown-divider my-2" style="border-top: 1px solid grey;"></div>

                                                <li class="dropdown-item show-password-toggle"
                                                    style="font-size: 12px; cursor: pointer;">
                                                    <span style="text-decoration: none; color: inherit;">
                                                        <i class="fas fa-eye me-1 eye-icon"></i>
                                                        <span class="toggle-text">@lang('Show Master Password')</span>
                                                    </span>
                                                    <div class="copy-feedback"
                                                        style="font-size: 10px; color: green; display: none; margin-left: 20px;">
                                                        Copied!</div>
                                                    <div class="password-box mt-1">
                                                        <span
                                                            class="password-text">{{ $real_acc->Master_Password ?? 'N/A' }}</span>
                                                    </div>
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
                        <!-- Leverage Change Modal for Real Accounts -->
                        <div class="modal fade" id="leverageModal-{{ $acc->Login }}" tabindex="-1"
                            aria-labelledby="leverageModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="leverageModalLabel">@lang('Change Leverage')</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="leverageForm-{{ $acc->Login }}"
                                            action="{{-- route('user.change.leverage') --}}" method="POST">
                                            @csrf
                                            <input type="hidden" name="account_id" value="{{ $real_acc->Login }}">
                                            <div class="mb-3">
                                                <label for="leverage" class="form-label">@lang('Select Leverage')</label>
                                                <select class="form-select" name="leverage" id="leverage">
                                                    <option value="100">100</option>
                                                    <option value="200">200</option>
                                                    <option value="300">300</option>
                                                    <option value="400">400</option>
                                                    <option value="500">500</option>
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-primary">@lang('Update Leverage')</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Model ends here-->
                        <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                            <div class="card rounded-10 shadow-sm text-center flex-fill">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <header class="d-flex justify-content-between align-items-center mb-3">
                                        <h5 class="text-start m-0" style="font-size:13px;">{{ $acc->Name }}</h5>
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
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#leverageModal-{{ $acc->Login }}"
                                                        style="text-decoration: none; color: inherit;">
                                                        @lang('Change Leverage')
                                                    </a>
                                                </li>

                                                <div class="dropdown-divider my-2" style="border-top: 1px solid grey;"></div>
                                                <li class="dropdown-item" style="font-size: 12px;">
                                                    <a href="#" style="text-decoration: none; color: inherit;">
                                                        @lang('Rename Account')</a>
                                                </li>
                                                <!-- ✅ Show/Hide Master Password Section -->
                                                <div class="dropdown-divider my-2" style="border-top: 1px solid grey;"></div>

                                                <li class="dropdown-item show-password-toggle"
                                                    style="font-size: 12px; cursor: pointer;">
                                                    <span style="text-decoration: none; color: inherit;">
                                                        <i class="fas fa-eye me-1 eye-icon"></i>
                                                        <span class="toggle-text">@lang('Show Master Password')</span>
                                                    </span>
                                                    <div class="copy-feedback"
                                                        style="font-size: 10px; color: green; display: none; margin-left: 20px;">
                                                        Copied!</div>
                                                    <div class="password-box mt-1">
                                                        <span class="password-text">{{ $acc->Master_Password ?? 'N/A' }}</span>
                                                    </div>
                                                </li>


                                            </ul>

                                        </div>
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

<style>
    .password-box {
        max-height: 0;
        opacity: 0;
        overflow: hidden;
        transition: max-height 0.4s ease, opacity 0.4s ease;
        font-size: 11px;
        color: #555;
        margin-top: 5px;
    }

    .password-box.show {
        max-height: 50px;
        /* adjust if password is long */
        opacity: 1;
    }
</style>


@push('script')
    <script>
        $(document).ready(function () {
            $('.show-password-toggle').on('click', function (e) {
                e.stopPropagation();
                e.preventDefault();

                const $card = $(this); // the current card context
                const $pwBox = $card.find('.password-box');
                const $pwText = $card.find('.password-text');
                const $eyeIcon = $card.find('.eye-icon');
                const $toggleText = $card.find('.toggle-text');
                const $copyFeedback = $card.find('.copy-feedback');

                $pwBox.toggleClass('show');

                if ($pwBox.hasClass('show')) {
                    $eyeIcon.removeClass('fa-eye').addClass('fa-eye-slash');
                    $toggleText.text('Hide Master Password');

                    // Copy to clipboard
                    const password = $pwText.text().trim();
                    if (password && password !== 'N/A') {
                        const $tempInput = $('<input>');
                        $('body').append($tempInput);
                        $tempInput.val(password).select();
                        document.execCommand('copy');
                        $tempInput.remove();

                        // Show copied feedback
                        $copyFeedback.fadeIn();
                        setTimeout(() => {
                            $copyFeedback.fadeOut();
                        }, 1500);
                    }

                } else {
                    $eyeIcon.removeClass('fa-eye-slash').addClass('fa-eye');
                    $toggleText.text('Show Master Password');
                    $copyFeedback.hide();
                }
            });
        });
    </script>
@endpush