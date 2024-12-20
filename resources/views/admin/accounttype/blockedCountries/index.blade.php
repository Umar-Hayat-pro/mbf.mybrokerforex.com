@extends('admin.layouts.app')

@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10">
                <div class="card-body p-0">
                    <div class="table-responsive--md table-responsive">
                        <table class="table table--light style--two highlighted-table">
                            <thead>
                                <tr>
                                    <th>@lang('Country')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($countriesForCurrentPage as $country)
                                    <tr>
                                        <td>{{ $country['name'] }}</td>
                                        <td>
                                            <div class="button--group">
                                                <form action="{{ route('admin.blacklist.destroy', $country['id']) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-outline--danger confirmationBtn" 
                                                            data-question="@lang('Are you sure you want to remove this country?')">
                                                        <i class="la la-trash"></i> @lang('Remove')
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-muted text-center" colspan="2">
                                            {{ __($emptyMessage) }}
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table><!-- table end -->
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
    {{-- <x-confirmation-modal /> --}}
@endsection

@push('breadcrumb-plugins')
    <a class="btn btn-outline--primary" href="{{ route('admin.blacklist.create') }}">
        <i class="las la-plus"></i> @lang('Add New Country to Blacklist')
    </a>
@endpush
