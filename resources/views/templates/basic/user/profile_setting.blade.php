@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card custom--card">
                    <div class="card-body p-0">
                        <div class="row gy-4 justify-content-center flex-wrap-reverse">
                            <div class="col-md-5 col-lg-4">
                                {{-- User Image and Information List --}}
                                <div class="user-image text-center">
                                    <img src="{{ getImage(getFilePath('userProfile') . '/' . $user->image, getFileSize('userProfile'), true) }}">
                                </div>
                                <ul class="list-group list-group-flush h-100 p-3 information-list">
                                    <li class="list-group-item d-flex flex-column justify-content-between border-0 bg-transparent">
                                        <span class="fw-bold text-muted">{{ $user->username }}</span>
                                        <small class="text-muted"> <i class="la la-user"></i> @lang('Username')</small>
                                    </li>
                                    <li class="list-group-item d-flex flex-column justify-content-between border-0 bg-transparent">
                                        <span class="fw-bold text-muted">{{ $user->email }}</span>
                                        <small class="text-muted"><i class="la la-envelope"></i> @lang('Email')</small>
                                    </li>
                                    <li class="list-group-item d-flex flex-column justify-content-between border-0 bg-transparent">
                                        <span class="fw-bold text-muted">+{{ $user->mobile }}</span>
                                        <small class="text-muted"><i class="la la-mobile"></i> @lang('Mobile')</small>
                                    </li>
                                    <li class="list-group-item d-flex flex-column justify-content-between border-0 bg-transparent">
                                        <span class="fw-bold text-muted">{{ $user->address->country ?? 'N/A' }}</span> 
										
                                        <small class="text-muted"><i class="la la-globe"></i> @lang('Country')</small>
                                    </li>
                                    <li class="list-group-item d-flex flex-column justify-content-between border-0 bg-transparent">
                                        <span class="fw-bold text-muted">{{ $user->address->address ?? 'N/A' }}</span>
										
                                        <small class="text-muted"><i class="la la-map-marked"></i> @lang('Address')</small>
                                    </li>
                                    <li class="list-group-item d-flex flex-column justify-content-between border-0 bg-transparent" 
										data-request-status="{{ $user->profile_request }}">
                                        @if ($user->profile_request === 0 || $user->profile_request === 3)
                                            <a href="{{ route('user.request.form') }}">
                                                <small class="fw-bold text-muted"><i class="la la-map-marked">
													</i> @lang('Request Permission')</small>
                                            </a>
                                        @elseif ($user->profile_request === 1)
                                            <small class="fw-bold text-muted">@lang('Request Approved')</small>
                                        @elseif ($user->profile_request === 2)
                                            <small class="fw-bold text-muted"><i class="la la-map-marked"></i> @lang('Request Pending')</small>
                                        @endif
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-7 col-lg-8">
                                <form class="register py-3 pe-3 ps-3 ps-md-0" action="" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <h5 class="mb-3">@lang('Update Profile')</h5>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label">@lang('First Name')</label>
                                                <input type="text" class="form-control form--control2" 
													   name="firstname" value="{{ $user->firstname }}" 
													   @if ($user->profile_request !== 1) readonly @endif required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label">@lang('Last Name')</label>
                                                <input type="text" class="form-control form--control2" 
													   name="lastname" value="{{ $user->lastname }}" 
													   @if ($user->profile_request !== 1) readonly @endif required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label">@lang('State')</label>
                                                <input type="text" class="form-control form--control2" name="state" value="{{ @$user->address->state }}" @if ($user->profile_request !== 1) readonly @endif>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label">@lang('City')</label>
                                                <input type="text" class="form-control form--control2" name="city" value="{{ @$user->address->city }}" @if ($user->profile_request !== 1) readonly @endif>
                                            </div>
                                        </div>
                                        <div class="col-12">  {{-- Address 100% --}}
                                            <div class="form-group">
                                                <label class="form-label">@lang('Address')</label>
                                                <input type="text" class="form-control form--control2" name="address" value="{{ @$user->address->address }}" @if ($user->profile_request !== 1) readonly @endif>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">  {{-- Zip Code 50% --}}
                                            <div class="form-group">
                                                <label class="form-label">@lang('Zip Code')</label>
                                                <input type="text" class="form-control form--control2" name="zip" value="{{ @$user->address->zip }}" @if ($user->profile_request !== 1) readonly @endif>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            {{-- Explanation: Sending country_code and country to controller,   Showing Selected country based on the user->country_code and comparing it with the $key that is how we are showing that bug fixed. --}}
                                            <div class="form-group">
                                                <label class="form-label">@lang('Country')</label>
                                                @if($user->profile_request == Status::REQUEST_APPROVE)
                                                <select name="country" class="form-control" required>
                                                    @foreach ($countries as $key => $country)
                                                    <option data-mobile_code="{{ $country->dial_code }}" value="{{ $key }}"  {{ $user->country_code == $key ? 'selected' : '' }}>
                                                        {{ __($country->country) }}</option>
                                                    @endforeach
                                                </select>
                                                @else
                                                    <input type="text" class="form-control form--control2" value="{{ @$user->address->country }}" readonly>
                                                    <small class="text-muted">@lang('Country can be changed after profile update request is approved')</small>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">@lang('Image')</label>
                                                <input type="file" class="form-control form--control2" name="image" @if ($user->profile_request !== 1) disabled @endif>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn--base w-100">@lang('Submit')</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function () {
            var requestStatus = $(".list-group-item[data-request-status]").data("request-status");

            if (requestStatus !== 1) { // Disable all fields if request is not approved
                $("input[readonly]").prop("readonly", true);
                $("input[disabled]").prop("disabled", true); // Disable the file input as well
            }
        });

        $(document).ready(function() {
    // Set initial country_code value based on the selected country
    let selectedOption = $('select[name=country] option:selected');
    $('#country_code').val(selectedOption.data('code'));

    // Update hidden country_code input when a new country is selected
    $('select[name=country]').on('change', function() {
        let countryCode = $(this).find(':selected').data('code');
        $('#country_code').val(countryCode);
    });
});

    </script>
@endpush
<style>
  .user-image {
    width: 150px;
    height: 150px;
    border-radius: 50%;
  }

  .user-image img {
    border-radius: inherit;
  }
</style>

