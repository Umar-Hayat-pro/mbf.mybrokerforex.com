@extends('admin.layouts.app')

@section('panel')
  <div class="row">
    <div class="col-lg-12">
      <div class="card b-radius--10">
        <div class="card-body p-0">
          <div class="table-responsive--sm table-responsive">
            <table class="table table--light style--two custom-data-table">
              <thead>
                <tr>
                  <th>@lang('Username')</th>
                  <th>@lang('Email')</th>
                  <th>@lang('KYC')</th>
                  <th>@lang('Ib Status')</th>
                  <th>@lang('Action')</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($paginator as $ibAccount)
                  <tr>
                    <td>{{ $ibAccount['firstname'] . ' ' . $ibAccount['lastname'] }}</td>
                    <td>{{ $ibAccount['email'] }}</td>
                    <td>
                      @if ($ibAccount['kv'] == 0)
                        <span class="badge badge--danger">@lang('Not Verified')</span>
                      @elseif($ibAccount['kv'] == 1)
                        <span class="badge badge--success">@lang('Verified')</span>
                      @else
                        <span class="badge badge--warning">@lang('Pending')</span>
                      @endif
                    </td>
                    <td>
                      @if ($ibAccount['partner'] == 1)
                      <span class="badge badge--success">@lang('Approved')</span>
                        @elseif ($ibAccount['partner'] == 3)
                        <span class="badge badge--danger">@lang('Rejected')</span>
                        @elseif( $ibAccount['partner'] == 2)
                        <span class="badge badge--warning">@lang('Pending')</span>
                        @else
                        <span class="badge badge--warning">@lang('UnProcessed')</span>
                        @endif
                    </td>
                    <td>
                      <div class="button--group">
                        @if ($ibAccount['partner'] != 0)
                          <a href="{{ route('admin.dataView', $ibAccount['id']) }}" class="btn btn-sm btn-outline--primary">
                            <i class="las la-desktop"></i> @lang('Details')
                          </a>
                        @endif
                        {{-- Delete button --}}
                        {{-- <form action="{{ route('admin.form_ib.destroy_by_user_id', $ibAccount['id']) }}" method="POST"
                          style="display:inline;">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-sm btn-outline--danger">
                            <i class="la la-trash"></i> @lang('Delete')
                          </button>
                        </form> --}}
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="6" class="text-center">@lang('No records found')</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer">
          {{ $paginator->links() }}
        </div>
      </div>
    </div>
  </div>
@endsection

@push('breadcrumb-plugins')
  <div class="d-inline">
    <div class="input-group justify-content-end d-flex gap-2">
      <div class="d-flex">
        <input type="text" name="search_table" class="form-control bg--white rounded-2"
          placeholder="@lang('Search')...">
        <button for='search_table' class="btn btn--primary input-group-text"><i class="fa fa-search"></i></button>
      </div>


      {{-- <button class="btn btn--primary input-group-text rounded-1">
        <a href="{{ route('admin.accounttype.create') }}" class="title-btn text--white me-2">Add me</a>
      </button> --}}

    </div>
  </div>
@endpush
