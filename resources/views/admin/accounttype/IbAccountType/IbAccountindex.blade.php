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
                  <th>@lang('TITLE')</th>
                  <th>@lang('GROUP')</th>
                  <th>@lang('BADGE')</th>
                  <th>@lang('STATUS')</th>
                  <th>@lang('ACTION')</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($pagination as  $accountData)
                  <tr>
                    <td>{{ $accountData['title'] }}</td>
                    <td>{{ $accountData['group'] }}</td>
                    <td>{{ $accountData['badge'] }}</td>
                    <td>{{ $accountData['status'] }}</td>
                    <td>
                      <div class="button--group">
                        {{-- Edit button --}}
                        <a href="{{ route('admin.ibaccounttype.edit',  $accountData['id']) }}" class="btn btn-sm btn-outline--primary">
                            <i class="la la-pencil"></i> Edit
                        </a>
                    
                        {{-- Delete button --}}
                        <form action="{{ route('admin.ibaccounttype.destroy', $accountData['id']) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline--danger">
                                <i class="la la-trash"></i> @lang('Delete')
                            </button>
                        </form>
                    </div>
                    
                      </div>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        @if ($pagination->hasPages())
          <div class="card-footer py-4">
            {{ $pagination->links() }}
          </div>
        @endif
      </div>
    </div>
  </div>

  <x-confirmation-modal />
@endsection

@push('breadcrumb-plugins')
  <div class="d-inline">
    <div class="input-group justify-content-end">
      <a href="{{ route('admin.ibaccounttype.create') }}">
        <button class="btn btn--primary input-group-text"><i class="fa fa-plus"></i> Add New</button>
      </a>
    </div>
  </div>
@endpush
