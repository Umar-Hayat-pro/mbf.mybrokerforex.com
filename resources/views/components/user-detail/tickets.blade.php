<div class="row mb--20">
  <div class="col-lg-12">
    <div class="card mt-30">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">@lang('Support Tickets')</h5>
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
                <th>@lang('Ticket name')</th>
                <th>@lang('Opening Date')</th>
                <th>@lang('Status')</th>
                <th>@lang('Action')</th>
              </tr>
            </thead>
            <tbody>

              <tr>
                <td>@lang('N/A')</td>
                <td>@lang('N/A')</td>
                <td>@lang('N/A')</td>

                <td>
                  <div class="button--group">
                    {{-- Edit button --}}
                    {{-- <a href="#" class="btn btn-sm btn-outline--primary">
                        <i class="la la-pencil"></i> @lang('Edit')
                      </a> --}}

                    {{-- Delete button --}}
                    {{-- <form action="#" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline--danger">
                          <i class="la la-trash"></i> @lang('Delete')
                        </button>
                      </form> --}}
                  </div>
                </td>
              </tr>
              {{-- @endforeach --}}
            </tbody>
          </table>
        </div>
      </div>
      <div class="card-footer">
        {{-- {{ $paginator->links() }} --}}
      </div>
    </div>
  </div>
</div>

<x-confirmation-modal />
