@extends('admin.layouts.app')
@section('panel')
  <div class="row">
    <div class="col-lg-12">
    <div class="card b-radius--10">
      <div class="card-body p-0">
      <div class="table-responsive--md table-responsive">
        <table class="table table-bordered  table--light style--two highlighted-table">
        <thead>
          <tr>
          <th>@lang('User')</th>
          <th>@lang('Email-Phone')</th>
          <th>@lang('Country')</th>
          <th>@lang('Balance')</th>
          <th>@lang('Equity')</th>
          <th>@lang('Credit')</th>
          <th>@lang('Joined At')</th>
          <th>@lang('Action')</th>
          </tr>
        </thead>
        <tbody>
          @forelse($users as $user)
        <tr>
        <td>
        <span class="fw-bold">{{ $user->fullname }}</span>
        <br>
        <span class="small">
        <a href="{{ route('admin.users.detail', $user->id) }}"><span>@</span>{{ $user->username }}</a>
        </span>
        </td>
        <td>
        <span class="d-block">{{ $user->email }}</span>
        {{ $user->mobile }}
        </td>
        <td>
        <span class="fw-bold" title="{{ @$user->address->country }}">{{ $user->country_code }}</span>
        </td>
        <td>
        <span class="fw-bold" title="{{ @$user->balance }}">{{ $user->balance ?? 0 }}</span>
        </td>
        <td>
        <span class="fw-bold" title="{{ @$user->equity }}">{{ $user->equity ?? 0 }}</span>
        </td>
        <td>
        <span class="fw-bold" title="{{ @$user->credit }}">{{ $user->credit ?? 0 }}</span>
        </td>
        <td>
        {{ showDateTime($user->created_at) }} <br> {{ diffForHumans($user->created_at) }}
        </td>
        <td>
        <div class="button--group">
        <a href="{{ route('admin.users.detail', $user->id) }}" class="btn btn-sm btn-outline--primary">
          <i class="las la-desktop"></i> @lang('Details')
        </a>
        @if (request()->routeIs('admin.users.kyc.pending'))
      <a href="{{ route('admin.users.kyc.details', $user->id) }}" target="_blank"
        class="btn btn-sm btn-outline--dark">
        <i class="las la-user-check"></i>@lang('KYC Data')
      </a>
    @endif
        @if (request()->routeIs('admin.users.request.pending', ))
      <a href="{{ route('admin.users.request.data', $user->id) }}" target="_blank"
        class="btn btn-sm btn-outline--dark">
        <i class="las la-user-check"></i>@lang('Show Request')
      </a>
    @endif
        </div>
        </td>
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
      @if ($users->hasPages())
      <div class="card-footer py-4">
      {{ paginateLinks($users) }}
      </div>
    @endif
    </div>
    </div>
  </div>
@endsection

@push('breadcrumb-plugins')
  <div class="card-footer2" style="background-color: #DC3545; padding: 0.5rem;">
    <a href="{{ url('users/export/') }}" class="title-btn me-2">Export Users</a>
  </div>
  <x-search-form placeholder="Username / Email" />
@endpush