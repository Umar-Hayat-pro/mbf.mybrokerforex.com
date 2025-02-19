@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="row justify-content-between gy-3 align-items-center">
        <div class="col-lg-4">
            <h4 class="mb-0">{{ __($pageTitle) }}</h4>
        </div>
        <div class="col-lg-4">
            <form class="d-flex gap-2 flex-wrap">
                <div class="flex-fill">
                    <select class="form-control form--control2 submit-form-on-change form-select" name="trade_side">
                        <option value="" selected disabled>@lang('Trade Side')</option>
                        <option value="">@lang('All')</option>
                        <option value="{{ Status::BUY_SIDE_TRADE }}"
                            @selected(request()->trade_side == Status::BUY_SIDE_TRADE)>@lang('Buy')</option>
                        <option value="{{ Status::SELL_SIDE_TRADE }}"
                            @selected(request()->trade_side == Status::SELL_SIDE_TRADE)>@lang('Sell')</option>
                    </select>
                </div>
                <div class="flex-fill">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control form--control" value="{{ request()->search }}"
                            placeholder="@lang('Pair,coin,currency...')">
                        <button type="submit" class="input-group-text bg-primary text-white">
                            <i class="las la-search"></i>
                        </button>
                    </div>
                </div>
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
                            <!-- <th>@lang('Pair')</th> -->
                            <!-- <th>@lang('Close Time')</th> -->
                            <!-- <th>@lang('Close Price')</th> -->
                            <!-- <th>@lang('Swap')</th> -->
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
@endsection