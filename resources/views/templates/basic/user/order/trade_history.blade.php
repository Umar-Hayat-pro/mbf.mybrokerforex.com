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
@endsection