@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="row justify-content-end gy-3">
        <div class="col-12">
            <div class="dashboard-header-menu justify-content-between">
                <div class="div">
                    <a href="{{ route('user.order.open') }}"
                        class="dashboard-header-menu__link   {{ menuActive('user.order.open')}}">@lang('Open')</a>
                    <a href="{{ route('user.order.history') }}"
                        class="dashboard-header-menu__link   {{ menuActive('user.order.history')}}">@lang('History')</a>
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


            </div>
        </div>
        <div class="col-lg-12">
            <div class="table-wrapper">
                <table class="table table--responsive--lg">
                    @php
                        $actionShow = request()->routeIs('user.order.open') || request()->routeIs('user.order.history');
                    @endphp
                    <thead>
                        <tr>
                            <th>@lang('Time')</th>
                            <th>@lang('Symbol')</th>
                            <th>@lang('Profit')</th>
                            <th>@lang('Commission')</th>
                            <th>@lang('Fee')</th>
                            <th>@lang('Ticket')</th>
                            <th>@lang('PriceSL')</th>
                            <th>@lang('PriceTP')</th>
                            <th>@lang('Volume')</th>
                            <th>@lang('Order')</th>
                        </tr>
                    </thead>
                    @if (request()->routeIs('user.order.open'))
                        @include('templates.basic.user.components.partials.open_orders')
                    @endif
                    @if(request()->routeIs('user.order.history'))
                        @include('templates.basic.user.components.partials.orders_history')
                    @endif
                </table>
            </div>
            @if ($orders->hasPages())
                {{ paginateLinks($orders) }}
            @endif
        </div>
    </div>
    </div>
    <x-confirmation-modal isCustom="true" />
@endsection

@push('topContent')
    <h4 class="mb-4">{{ __($pageTitle) }}</h4>
@endpush

@push('script')
    <script>
        "use strict";
        (function ($) {

            $('table').on('click', '.order-update-form-remove', function (e) {
                $(`.order--rate`).removeClass('d-none');
                $(`.order--amount`).removeClass('d-none');
                $(this).closest('.order-update-form').remove();
            })

            let editColumn = null;

            $('table').on('click', '.amount-rate-update', function (e) {

                $('.order-update-form').remove();
                $(`.order--rate`).removeClass('d-none');
                $(`.order--amount`).removeClass('d-none');

                editColumn = $(this).closest('td');

                let order = $(this).attr('data-order');
                order = JSON.parse(order);
                let updateField = $(this).data('update-filed');
                let action = "{{ route('user.order.update', ':id') }}";

                let html = `<form class="order-update-form" action="${action.replace(':id', order.id)}">
                                                                                                                                                                                                                                                        <input type="hidden" name="update_filed" value="${updateField}">
                                                                                                                                                                                                                                                        <div class="input-group">
                                                                                                                                                                                                                                                            <span class="input-group-text">
                                                                                                                                                                                                                                                                ${updateField == 'amount' ? "@lang('Amount')" : "@lang('Rate')"}
                                                                                                                                                                                                                                                            </span>
                                                                                                                                                                                                                                                            <input type="text" class="form--control form-control" name="${updateField}"  value="${updateField == 'amount' ? getAmount(order.amount) : getAmount(order.rate)}">
                                                                                                                                                                                                                                                            <button type="submit" class="input-group-text">
                                                                                                                                                                                                                                                                <i class="fas fa-check text--success"></i>
                                                                                                                                                                                                                                                            </button>
                                                                                                                                                                                                                                                            <button type="button" class="input-group-text order-update-form-remove">
                                                                                                                                                                                                                                                                <i class="fas fa-times text--danger"></i>
                                                                                                                                                                                                                                                            </button>
                                                                                                                                                                                                                                                        </div>
                                                                                                                                                                                                                                                    </form>`;
                editColumn.find('.order--amount-rate-wrapper').append(html);
            });

            $('table').on('submit', '.order-update-form', function (e) {
                e.preventDefault();

                let formData = new FormData($(this)[0]);
                let action = $(this).attr('action');
                let token = "{{ csrf_token() }}";
                let $this = $(this);

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': token
                    },
                    url: action,
                    method: "POST",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function () {
                        $($this).find('button[type=submit]').html(`<i class="fa fa-spinner fa-spin text--success"></i>`);
                        $($this).find('button[type=button]').addClass('d-none');
                        $($this).attr(`disabled`, true);
                    },
                    complete: function () {
                        $($this).find('button[type=submit]').html(`<i class="fa fa-check text--success"></i>`);
                        $($this).find('button[type=button]').removeClass('d-none');
                        $($this).attr(`disabled`, false);
                    },
                    success: function (resp) {
                        if (resp.success) {
                            editColumn.find(`.order--rate`).removeClass('d-none');
                            editColumn.find(`.order--amount`).removeClass('d-none');
                            editColumn.find('.order-update-form').remove();

                            let newOrder = editColumn.find('.amount-rate-update').data('order');
                            if (resp.data.order_amount) {
                                editColumn.find(`.order--amount-value`).text(getAmount(resp.data.order_amount));
                                newOrder.amount = getAmount(resp.data.order_amount);
                            }
                            if (resp.data.order_rate) {
                                editColumn.find(`.order--rate-value`).text(getAmount(resp.data.order_rate));
                                newOrder.rate = getAmount(resp.data.order_rate);
                            }
                            editColumn.find('.amount-rate-update').attr('data-order', JSON.stringify(newOrder))
                            notify('success', resp.message);
                        } else {
                            notify('error', resp.message);
                        }
                    },
                });
            });

        })(jQuery);
    </script>
@endpush