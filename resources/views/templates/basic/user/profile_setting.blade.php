@extends($activeTemplate . 'layouts.master')
@section('content')
  <div class="container">
    <div class="row justify-content-center">
    <div class="col-lg-10">
      <div class="card custom--card">
      <div class="card-body p-0">
        <div class="row gy-4 justify-content-center flex-wrap-reverse">
        <div class="col-md-5 col-lg-4">
          <div class="user-image text-center">
          <img
            src="{{ getImage(getFilePath('userProfile') . '/' . $user->image, getFileSize('userProfile'), true) }}">
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
            <span class="fw-bold text-muted">{{ $user->address->country }}</span>
            <small class="text-muted"><i class="la la-globe"></i> @lang('Country')</small>
          </li>
          <li class="list-group-item d-flex flex-column justify-content-between border-0 bg-transparent">
            <span class="fw-bold text-muted">{{ $user->address->address }}</span>
            <small class="text-muted"><i class="la la-map-marked"></i> @lang('Address')</small>
          </li>
          <li class="list-group-item d-flex flex-column justify-content-between border-0 bg-transparent"
            data-request-status="{{ $user->profile_request }}">
            @if ($user->profile_request === 0)
        <a href="{{ route('user.request.form') }}">
        <small class="fw-bold text-muted"><i class="la la-map-marked"></i>
          @lang('Request Permission')</small>
        </a>
      @elseif ($user->profile_request === 1)
    <small class="fw-bold text-muted">@lang('Request Approved')</small>
  @elseif ($user->profile_request === 2){

  <small class="fw-bold text-muted"><i class="la la-map-marked"></i>
  @lang('Request Pending')</small>
  }
@else
  <a href="{{ route('user.request.form') }}">
  <small class="fw-bold text-muted"><i class="la la-map-marked"></i>
    @lang('Request Permission')</small>
  </a>

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
              <input type="text" class="form-control form--control2" name="firstname"
              value="{{ $user->firstname }}" readonly required>
            </div>
            </div>
            <div class="col-lg-6">
            <div class="form-group">
              <label class="form-label">@lang('Last Name')</label>
              <input type="text" class="form-control form--control2" name="lastname"
              value="{{ $user->lastname }}" readonly required>
            </div>
            </div>
            <div class="col-lg-6">
            <div class="form-group">
              <label class="form-label">@lang('State')</label>
              <input type="text" class="form-control form--control2" name="state"
              value="{{ @$user->address->state }}" readonly>
            </div>
            </div>
            <div class="col-lg-6">
            <div class="form-group">
              <label class="form-label">@lang('City')</label>
              <input type="text" class="form-control form--control2" name="city"
              value="{{ @$user->address->city }}" readonly>
            </div>
            </div>
            <div class="col-lg-6">
            <div class="form-group">
              <label class="form-label">@lang('Zip Code')</label>
              <input type="text" class="form-control form--control2" name="zip"
              value="{{ @$user->address->zip }}" readonly>
            </div>
            </div>
            <div class="col-lg-6">
            <div class="form-group">
              <label class="form-label">@lang('Address')</label>
              <input type="text" class="form-control form--control2" name="address"
              value="{{ @$user->address->address }}" readonly>
            </div>
            </div>
            <div class="col-12">
            <div class="form-group">
              <label class="form-label">@lang('Image')</label>
              <input type="file" class="form-control form--control2" name="image">
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

@push('script')
  <script>



    $(document).ready(function () {
    // Get the request status from the data attribute
    var requestStatus = $(".list-group-item[data-request-status]").data("request-status");

    // If status is 1 (Approved), enable input fields
    if (requestStatus === 1) {
      $("input[readonly]").prop("readonly", false);
    }
    });



  </script>
@endpush