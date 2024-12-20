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
                  <th>@lang('ICON')</th>
                  <th>@lang('PRIORITY')</th>
                  <th>@lang('TITLE')</th>
                  <th>@lang('LEVERAGE')</th>
                  <th>@lang('COUNTRY')</th>
                  <th>@lang('BADGE')</th>
                  <th>@lang('STATUS')</th>
                  <th>@lang('ACTION')</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($paginator as $accountType)
                  <tr>
                    <td>
                      <img src="{{ asset('assets/images/logoIcon/favicon.png') }}" alt="logo.icon" style="width: 32px; height: 32px; object-fit: contain;">
                    </td>
                    <td>{{ $accountType['priority'] }}</td>
                    <td>{{ $accountType['title'] }}</td>
                    <td>{{ $accountType['leverage'] }}</td>
                    @php
                    $selectedCountries = json_decode($accountType['country'],true) ?? [];
                    $formattedCountry = implode(' , ', $selectedCountries);
                    @endphp
                    <td> {{ $formattedCountry ?? 'N?A' }}</td>
                    <td>
                      <span class="badge badge--success">{{ $accountType['badge'] }}</span></td>
                    <td>
                      @if( $accountType['status'] == 'Active' )
                      <span class="badge badge--success">@lang('Active')</span>
                      @else
                      <span class="badge badge--danger">@lang('Inactive')</span>
                      @endif
                    </td>
                    <td>
                      <div class="button--group">
                        {{-- Edit button --}}
                        <a href="{{ route('admin.accounttype.edit',  $accountType['id']) }}" class="btn btn-sm btn-outline--primary">
                            <i class="la la-pencil"></i> Edit
                        </a>
                    
                        {{-- Delete button --}}
                        <form action="{{ route('admin.accounttype.destroy', $accountType['id']) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline--danger">
                                <i class="la la-trash"></i> @lang('Delete')
                            </button>
                        </form>
                    </div>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer py-4">
          {{ $paginator->links() }}
        </div>
      </div>
    </div>
  </div>

  <x-confirmation-modal />
@endsection

@push('breadcrumb-plugins')
  <div class="d-inline">
    <div class="input-group justify-content-end">
      <a href="{{ route('admin.accounttype.create') }}">
        <button class="btn btn--primary input-group-text"><i class="fa fa-plus"></i> Add New</button>
      </a>
    </div>
  </div>
@endpush
