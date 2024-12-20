@extends('admin.layouts.app')

@section('panel')
    <div class="row mb-none-30 mb-3 align-items-center gy-4">
        <div class="col-xxl-3 col-sm-6 mb-3">
            <x-widget style="2" link="#" icon="las la-users f-size--56" icon_style="false" title="Total Accounts"
                value="{{ $widget['total_users'] }}" color="primary" />
        </div><!-- dashboard-w1 end -->
        <div class="col-xxl-3 col-sm-6 mb-3">
            <x-widget style="2" link="#" icon="las la-user-check f-size--56" title="Active Accounts"
                icon_style="false" value="{{ $widget['active_accounts'] }}" color="success" />
        </div>
        <div class="col-xxl-3 col-sm-6 mb-3">
            <x-widget style="2" link="#" icon="lar la-envelope f-size--56" icon_style="false"
                title="Inactive Accounts" value="{{ $widget['inactive_accounts'] }}" color="danger" />
        </div>
        <div class="col-xxl-3 col-sm-6 mb-3">
            <x-widget style="2" icon_style="false" link="#" icon="las la-dollar-sign f-size--56"
                title="Total Balance" value="{{ $widget['total_balance'] }}" color="green" />
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10">
                <div class="card-body p-0">
                    <div class="table-responsive--md table-responsive">
                        <table class="table table-bordered table--light style--two highlighted-table" id="accountsTable">
                            <thead>
                                <tr>
                                    <th>@lang('ACCOUNT NUMBER')</th>
                                    <th>@lang('USER')</th>
                                    <th>@lang('GROUP')</th>
                                    <th>@lang('LEVERAGE')</th>
                                    <th>@lang('BALANCE')</th>
                                    <th>@lang('AGENT/IB NUMBER')</th>
                                    <th>@lang('STATUS')</th>
                                    <th>@lang('Actions')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($accounts as $account)
                                    <tr>
                                        <td>
                                            <span class="fw-bold">
                                                {{ $account->Login }}
                                            </span>
                                            </td>
                                        <td>
                                            <span class="fw-bold">
                                                {{ $account->Name }}
                                            </span>
                                        </td>
                                        <td>{{ $account->Group }}</td>
                                        <td>
                                            <span class="fw-bold">
                                                {{ $account->Leverage }}
                                            </span>
                                        </td>
                                        <td>
                                             <span class="fw-bold">
                                                {{ $account->Balance }}
                                            </span>
                                        </td>
                                        <td>
                                            @if ($account->Agent !== 0)
                                                <span class="fw-bold">
                                                    {{ $account->Agent }}
                                                </span>
                                            @else
                                                @lang('N/A')
                                            @endif
                                        </td>
                                        <td>
                                            @if ($account->Status == 'RE')
                                                <span class="badge badge--success">Active</span>
                                            @else
                                                <span class="badge badge--danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            {{-- {{ route('admin.users.detail', $account->Login) }} --}}
                                            <div class="button--group">
                                                <a href="#"
                                                    class="btn btn-sm btn-outline--primary">
                                                    <i class="fa fa-edit"></i> @lang('')
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if ($accounts->hasPages())
                        <div class="card-footer py-4">
                            {{ paginateLinks($accounts) }} <!-- Pagination links -->
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection


@push('breadcrumb-plugins')
  <x-search-form placeholder="Username / Email" />
@endpush
