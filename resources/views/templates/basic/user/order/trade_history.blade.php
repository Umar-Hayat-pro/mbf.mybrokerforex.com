@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="row justify-content-between gy-3 align-items-center">
        <div class="col-lg-4">
            <h4 class="mb-0">{{ __($pageTitle) }}</h4>
        </div>
        <div class="col-4">
            <form method="GET" action="">
                <select name="login" class="form-select" onchange="this.form.submit()">
                    <option value="all" {{ request('login') == 'all' ? 'selected' : '' }}>All</option>
                    @foreach($userLogins as $login)
                        <option value="{{ $login }}" {{ request('login') == $login ? 'selected' : '' }}>
                            {{ $login }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>
        <div class="col-lg-12">
            <div class="table-wrapper">
                <table class="table table--responsive--lg">
                    <thead>
                        <tr>
                            <th>@lang('Time')</th>
                            <th>@lang('Ticket')</th>
                            <th>@lang('Open Price')</th>
                            <th>@lang('Volume')</th>
                            <th>@lang('SL')</th>
                            <th>@lang('TL')</th>
                            <th>@lang('Commission')</th>
                            <th>@lang('Fee')</th>
                            <th>@lang('Profit')</th>
                            <th>@lang('Comment')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($trades as $trade)
                            <tr>
                                <td>
                                    {{ $trade->Time}}
                                </td>
                                <td>
                                    {{ @$trade->PositionID }}
                                </td>
                                <td>
                                    {{ round($trade->Price, 2) }}

                                </td>
                                <td>
                                    {{ round($trade->Volume, 2) }}
                                </td>
                                <td>
                                    {{ $trade->PriceSL }}
                                </td>
                                <td>
                                    {{ $trade->PriceTP }}
                                </td>
                                <td>
                                    {{ $trade->Commission }}
                                </td>
                                <td>
                                    {{ $trade->Fee }}
                                </td>
                                <td>
                                    {{ $trade->Profit }}
                                </td>
                                <td>
                                    <small>
                                        {{ $trade->Comment }}
                                    </small>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                @php echo userTableEmptyMessage('trade') @endphp
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    {{-- Sticky trading widget --}}
    <div class="trading-account-info-wrapper">
        <div class="trading-account-info mx-2">
            <div class="d-flex justify-content-between align-items-center bg--red p-2 rounded">
                <div class="info-item">
                    <span class="label">Balance:</span>
                    <span class="value" data-type="balance">{{ number_format($tradingAccount->balance ?? 0, 2) }} USD</span>
                </div>
                <div class="info-item">
                    <span class="label">Equity:</span> 
                    <span class="value" data-type="equity">{{ number_format($tradingAccount->equity ?? 0, 2) }}</span>
                </div>
                <div class="info-item">
                    <span class="label">Margin:</span>
                    <span class="value" data-type="margin">{{ number_format($tradingAccount->margin ?? 0, 2) }}</span>
                </div>
                <div class="info-item">
                    <span class="label">Free Margin:</span>
                    <span class="value" data-type="freeMargin">{{ number_format($tradingAccount->freeMargin ?? 0, 2) }}</span>
                </div>
                <div class="info-item">
                    <span class="label">Margin Level:</span>
                    <span class="value" data-type="marginLevel">{{ number_format($tradingAccount->marginLevel ?? 0, 2) }}%</span>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('style')
<style>
/* Sticky widget styles */
.trading-account-info-wrapper {
    position: sticky;
    bottom: 0;
    margin-top: 20px;
    background: var(--section-bg);
    padding: 0.3rem 0;
    z-index: 4;
}

.trading-account-info {
    font-size: 12px;
}

.bg--red {
    background-color: #e6e6e670 !important;
    border: 1px solid lightgrey;
}

.trading-account-info .info-item {
    padding: 0 50px;
    border-right: 1px solid rgba(0,0,0,0.2);
}

.trading-account-info .info-item:last-child {
    border-right: none;
}

.trading-account-info .label {
    font-weight: 500;
    margin-right: 5px;
    color: #000;
}

.trading-account-info .value {
    font-weight: 600;
    color: #000;
}
</style>
@endpush

@push('script')
<script>
(function($) {
    "use strict";
    
    // Function to update widget data
    function updateWidgetData() {
        $.ajax({
            url: '{{ route("user.account.data") }}',
            method: 'GET',
            data: {
                login: '{{ request("login", "all") }}'
            },
            success: function(response) {
                Object.keys(response).forEach(key => {
                    const element = document.querySelector(`.trading-account-info .value[data-type="${key}"]`);
                    if (element) {
                        element.textContent = parseFloat(response[key]).toLocaleString('en-US', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        }) + (key === 'marginLevel' ? '%' : '');
                    }
                });
            }
        });
    }

    // Update data every 5 seconds
    setInterval(updateWidgetData, 3000);
    
})(jQuery);
</script>
@endpush