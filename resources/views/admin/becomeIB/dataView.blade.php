@extends('admin.layouts.app')

@section('panel')
  <div class="row">
    <div class="col-lg-12">
      <div class="card b-radius--10">
        <div class="card-body p-0">

          <div class="card-header">
            <h5 class="card-title mb-0">@lang('Information of')
              {{ $formData->username ?? 'N/A' }}
            </h5>
            <div class="form-group col-xl-3 col-md-6 col-12">
              {{-- Status Message --}}
              <div class="status-message">
                @if ($formData->partner == 1)
                  <p class="text-success">@lang('User is approved')</p>
                @elseif ($formData->partner == 3)
                  <p class="text-danger">@lang('User is Rejected')</p>
                @elseif ($formData->partner == 2)
                  <p class="text-warning">@lang('User is in Pending')</p>
                @else
                  <p class="text-muted">@lang('No status available')</p>
                @endif
              </div>
            </div>
            <form method="POST" action="{{ route('admin.become_ib.update', $formData->user_id) }}"
              enctype="multipart/form-data">
              @csrf
              @method('PUT')

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>@lang('Selected Country')</label>
                    <input class="form-control" type="text" name="selectedCountry" value="{{ $formData->country }}"
                      readonly>
                  </div>
                </div>



                <div class="col-md-6">
                  <div class="form-group">
                    <label>@lang('Market Services')</label>
                    <input class="form-control" type="text" name="services" value="{{ $formData->services ?? 'N/A' }}"
                      readonly>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    @php
                      $selectedOptions = json_decode($formData->selectable_options, true) ?? [];
                      $formattedOptions = implode(' & ', $selectedOptions);
                    @endphp
                    <label>@lang('How Do You Attract Your Clients')</label>
                    <input type="text" name="selectable_options" class="form-control"
                      value="{{ $formattedOptions ?? 'N/A' }}" readonly>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    @php
                      $backgroundOptions = json_decode($formData->background_options, true) ?? [];
                      $formattedBackground = implode(' & ', $backgroundOptions);
                    @endphp
                    <label>@lang('Brokers Background')</label>
                    <input type="text" name="background_options" class="form-control"
                      value="{{ $formattedBackground ?: 'N/A' }}" readonly>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>@lang('Trading Volume (In Standard Lots) 3 Months')</label>
                    <input class="form-control" type="text" name="tradingVolume"
                      value="{{ $formData->trading_volume ?? 'N/A' }}" readonly required>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>@lang('How Many Clients in 3 Months')</label>
                    <input class="form-control" type="text" name="expected_clients"
                      value="{{ $formData->expected_clients ?? 'N/A' }}" readonly required>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>@lang('How Many Active Clients')</label>
                    <input class="form-control" type="text" name="active_clients"
                      value="{{ $formData->active_clients ?? 'N/A' }}" readonly required>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>@lang('Email')</label>
                    <input class="form-control" type="text" name="email" value="{{ $formData->email ?? 'N/A' }}"
                      readonly>
                  </div>
                </div>
              </div>


              <div class="row mt-4">
                <div class="col-md-12">
                  <div class="form-group">
                    <button type="submit" name="ib_status" value="1"
                      class="btn  w-25 h-45 btn-outline--success">@lang('Approve')</button>
                    <button type="submit" name="ib_status" value="3"
                      class="btn  w-25 h-45 btn-outline--danger">@lang('Reject')</button>
                  </div>
                </div>
              </div>
              
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection


@push('script')
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const ibApprovalCheckbox = document.getElementById('ibApprovalCheckbox');
      const ibStatusInput = document.querySelector('input[name="ib_status"]');

      // Set initial state based on existing data
      if (ibApprovalCheckbox.checked) {
        ibStatusInput.value = 1; // Approved
      } else {
        ibStatusInput.value = 2; // Rejected
      }

      ibApprovalCheckbox.addEventListener('change', function() {
        ibStatusInput.value = ibApprovalCheckbox.checked ? 1 : 2; // Set to approved or rejected
      });
    });
  </script>
@endpush

@push('script')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <script>
    @if (Session::has('toastr'))
      {{ Session::get('toastr') }}
    @endif
  </script>
@endpush
