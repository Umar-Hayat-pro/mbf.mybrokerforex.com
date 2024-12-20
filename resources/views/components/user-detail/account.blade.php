<div class="row mb--20">
  <div class="col-lg-12">
    <div class="card mt-30">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">@lang('Account')</h5>
        <!-- Uncomment if needed 
        <a href="#" class="btn btn--primary">
          <i class="fa fa-plus"></i> @lang('Add New')
        </a>
        -->
      </div>
      <div class="card-header d-flex justify-content-between align-items-center">
        <div>
          <label for="show-entries">@lang('Show')</label>
          <select id="show-entries" class="form-select" style="width: auto; display: inline-block;">
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
            <option value="100">100</option>
          </select>
          <span>@lang('entries')</span>
        </div>

        <div>
          <label for="search">@lang('Search:')</label>
          <input type="text" id="search" class="form-control" style="width: 200px; display: inline-block;">
        </div>
      </div>

      <div class="card-body p-0">
        <div class="table-responsive--sm table-responsive">
          <table class="table table--light style--two custom-data-table">
            <thead>
              <tr>
                <th>@lang('Login')</th>
                <th>@lang('Group')</th>
                <th>@lang('Balance')</th>
                <th>@lang('Equity')</th>
                <th>@lang('Credit')</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($accounts as $acc)
                <tr>
                  <td>{{ $acc->Login }}</td>
                  <td>{{ $acc->Group }}</td>
                  <td>{{ $acc->Balance }}</td>
                  <td>{{ $acc->EquityPrevDay }}</td>
                  <td>{{ $acc->Credit }}</td>
                </tr>
              @empty
                <tr>
                  <td colspan="5" class="text-center">@lang('Data not found')</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>

      <div class="card-footer py-4">
        {{-- Pagination links --}}
        {{-- {{ $paginator->links() }} --}}
      </div>
    </div>
  </div>
</div>

<x-confirmation-modal />
