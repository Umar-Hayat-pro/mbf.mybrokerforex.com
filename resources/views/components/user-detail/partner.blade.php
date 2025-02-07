<div class="row mb--20">
  <div class="col-lg-12">
    <div class="card mt-30">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">@lang('IB Account')</h5>
        <div>
          <a href="#" class="btn btn--primary">
            <i class="fa fa-plus"></i> @lang('Add New IB')
          </a>
          <a href="#" class="btn btn--primary">
            <i class="fa fa-plus"></i> @lang('Update IB')
          </a>
          <a href="#" class="btn btn--primary">
            <i class="fa fa-plus"></i> @lang('Add New Multi IB')
          </a>
          <a href="#" class="btn btn--primary">
            <i class="fa fa-plus"></i> @lang('Update Multi IB')
          </a>
        </div>
      </div>
      <div class="card-body p-0">
        <div class="table-responsive--sm table-responsive">
          <table class="table table--light style--two custom-data-table">
            <thead>
              <tr>
                <th>@lang('Login')</th>
                <th>@lang('Name')</th>
                <th>@lang('Group')</th>
                <th>@lang('Balance')</th>
              </tr>
            </thead>
            <tbody>
              @forelse($ibaccount as $ib)
          <tr>
          <td>@lang($ib->Login)</td>
          <td>@lang($ib->Name)</td>
          <td>@lang($ib->Group)</td>
          <td>@lang($ib->Balance)</td>
          </tr>
        @empty
        <tr>
        <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
        </tr>
      @endforelse
            </tbody>
          </table>
        </div>
      </div>
      {{--@if($ibaccount->hasPages())
      <div class="card-footer">
        {{ paginateLinks($accounts)}}
      </div>
      @endif
      --}}
    </div>
  </div>
</div>

<x-confirmation-modal />