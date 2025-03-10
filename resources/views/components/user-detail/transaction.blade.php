<div class="row mb--20">
  <div class="col-lg-12">
    <div class="card mt-30">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">@lang('Transaction')</h5>
      </div>
      

      <div class="card-body p-0 b-radius--10 ">
            <div class="card-body p-0">
                <div class="table-responsive--sm table-responsive">
                    <table class="table table--light style--two custom-data-table">
                        <thead>
                            <tr>
                                <th>@lang('Currency | Wallet')</th>
                                <th>@lang('User')</th>
                                <th>@lang('TRX')</th>
                                <th>@lang('Transacted')</th>
                                <th>@lang('Amount')</th>
                                <th>@lang('Post Balance')</th>
                                <th>@lang('Details')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transactions as $trx)
                                <tr>
                                    <td>
                                        <div class="text-end text-lg-start">
                                            <span>{{ @$trx->wallet->currency->symbol }}</span>
                                            <br>
                                            <small>{{ @$trx->wallet->name }} | {{__(strToUpper(@$trx->wallet->type_text))}} </small> 
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bold">{{ $trx->user->fullname }}</span>
                                        <br>
                                        <span class="small"> <a href="{{ appendQuery('search',$trx->user->username) }}"><span>@</span>{{ $trx->user->username }}</a> </span>
                                    </td>

                                    <td>
                                        <strong>{{ $trx->trx }}</strong>
                                    </td>

                                    <td>
                                        {{ showDateTime($trx->created_at) }}<br>{{ diffForHumans($trx->created_at) }}
                                    </td>

                                    <td class="budget">
                                        <span class="fw-bold @if($trx->trx_type == '+')text--success @else text--danger @endif">
                                            {{ $trx->trx_type }} {{showAmount($trx->amount)}} {{ __(@$trx->wallet->currency->symbol) }}
                                        </span>
                                    </td>

                                    <td class="budget">
                                        {{ showAmount($trx->post_balance) }} {{ __(@$trx->wallet->currency->symbol) }}
                                    </td>

                                    <td>{{ __($trx->details) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                </tr>
                            @endforelse

                    </tbody>
                </table><!-- table end -->
            </div>
        </div>
        </div>
        @if($transactions->hasPages())
        <div class="card-footer py-4">
            {{ paginateLinks($transactions) }}
        </div>
        @endif
    </div><!-- card end -->
  </div>
</div>

<x-confirmation-modal />
