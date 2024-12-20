<div class="row mb--20">
  <div class="col-lg-12">
    <div class="card mt-30">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">@lang('Transaction')</h5>
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
                <th>@lang('Date')</th>
                <th>@lang('Transaction ID')</th>
                <th>@lang('Type')</th>
                <th>@lang('Amount')</th>
                <th>@lang('Gateway')</th>
                <th>@lang('Status')</th>
              </tr>
            </thead>
            <tbody>

              <tr>
                <td>@lang('N/A')</td>
                <td>@lang('N/A')</td>
                <td>@lang('N/A')</td>
                <td>@lang('N/A')</td>
                <td>@lang('N/A')</td>
                <td>@lang('N/A')</td>
              </tr>
              {{-- @endforeach --}}
            </tbody>
          </table>
        </div>
      </div>
      {{-- <div class="card-footer">
        for pagination
      </div> --}}
    </div>
  </div>
</div>

<x-confirmation-modal />
