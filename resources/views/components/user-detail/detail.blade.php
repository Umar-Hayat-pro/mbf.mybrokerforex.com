<div class="card mt-30">
    <div class="card-header">
      <h5 class="card-title mb-0">@lang('Information of') {{ $user->fullname }}</h5>
    </div>
    <div class="card-body">
      <form action="{{ route('admin.users.update', $user->id ) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
          <div class="col-md-2 d-flex flex-column">
            <div class="form-group checkbox-group">
              <label>@lang('Email Verification')</label>
              <input type="checkbox" data-width="100%" data-onstyle="-success" data-offstyle="-danger"
                data-bs-toggle="toggle" data-on="@lang('Verified')" data-off="@lang('Unverified')" name="ev"
                @if ($user->ev ) checked @endif>
            </div>
            <div class="form-group checkbox-group">
              <label>@lang('Mobile Verification')</label>
              <input type="checkbox" data-width="100%" data-onstyle="-success" data-offstyle="-danger"
                data-bs-toggle="toggle" data-on="@lang('Verified')" data-off="@lang('Unverified')" name="sv"
                @if ($user->sv ) checked @endif>
            </div>
            <div class="form-group checkbox-group">
              <label>@lang('2FA Verification')</label>
              <input type="checkbox" data-width="100%" data-height="50" data-onstyle="-success" data-offstyle="-danger"
                data-bs-toggle="toggle" data-on="@lang('Enable')" data-off="@lang('Disable')" name="ts"
                @if ($user->ts ) checked @endif>
            </div>
            <div class="form-group checkbox-group">
              <label>@lang('KYC')</label>
              <input type="checkbox" data-width="100%" data-height="50" data-onstyle="-success"
                  data-offstyle="-danger" data-bs-toggle="toggle" data-on="@lang('Verified')"
                  data-off="@lang('Unverified')" name="kv"
                  @if ($user->kv ) checked @endif>
          </div>
            <div class="form-group checkbox-group">
              <label>@lang('Deposit Status')</label>
              <input type="checkbox" data-width="100%" data-height="50" data-onstyle="-success"
                data-offstyle="-danger" data-bs-toggle="toggle" data-on="@lang('Verified')"
                data-off="@lang('Unverified')" name="deposit_status" @if ($user->deposit_status ) checked @endif>
            </div>
            <div class="form-group checkbox-group">
              <label>@lang('Withdraw Status')</label>
              <input type="checkbox" data-width="100%" data-height="50" data-onstyle="-success"
                data-offstyle="-danger" data-bs-toggle="toggle" data-on="@lang('Verified')"
                data-off="@lang('Unverified')" name="withdraw_status" @if ($user->withdraw_status ) checked @endif>
            </div>
            <div class="form-group checkbox-group">
              <label>@lang('Send Money Status')</label>
              <input type="checkbox" data-width="100%" data-height="50" data-onstyle="-success"
                data-offstyle="-danger" data-bs-toggle="toggle" data-on="@lang('Verified')"
                data-off="@lang('Unverified')" name="send_money_status" @if ($user->send_money_status ) checked @endif>
            </div>
          </div>

          <!-- Main Form Section on the Right -->
          <div class="col-md-10">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>@lang('First Name')</label>
                  <input class="form-control" type="text" name="firstname" required value="{{ $user->firstname }}">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label class="form-control-label">@lang('Last Name')</label>
                  <input class="form-control" type="text" name="lastname" required value="{{ $user->lastname  }}">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>@lang('Email')</label>
                  <input class="form-control" type="email" name="email" value="{{ $user->email  }}" required>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>@lang('Mobile Number')</label>
                  <div class="input-group">
                    <span class="input-group-text mobile-code"></span>
                    <input type="number" name="mobile" value="{{ old('mobile') }}" id="mobile"
                      class="form-control checkUser" required>
                  </div>
                </div>
              </div>
            </div>

            <div class="row mt-4">
              <div class="col-md-12">
                <div class="form-group ">
                  <label>@lang('Address')</label>
                  <input class="form-control" type="text" name="address" value="{{ @$user->address->address }}">
                </div>
              </div>

              <div class="col-xl-4 col-md-6">
                <div class="form-group">
                  <label>@lang('City')</label>
                  <input class="form-control" type="text" name="city" value="{{ @$user->address->city  }}">
                </div>
              </div>

              <div class="col-xl-4 col-md-6">
                <div class="form-group ">
                  <label>@lang('State')</label>
                  <input class="form-control" type="text" name="state" value="{{ @$user->address->state }}">
                </div>
              </div>

              <div class="col-xl-4 col-md-6">
                <div class="form-group ">
                  <label>@lang('Zip/Postal')</label>
                  <input class="form-control" type="text" name="zip" value="{{ @$user->address->zip }}">
                </div>
              </div>


              <div class="col-md-6">
                <div class="form-group ">
                  <label>@lang('Account Types')</label>
                  <input class="form-control" type="text" name="account_type" value="{{ @$user->account_type ?? "N/A" }}">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group ">
                  <label>@lang('Country')</label>
                  <select name="country" class="form-control" required>
                    @foreach ($countries as $key => $country)
                      <option data-mobile_code="{{ $country->dial_code }}" value="{{ $key }}" >
                        {{ __($country->country) }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>



            <!-- Submit Button -->
            <div class="row mt-4">
              <div class="col-md-12">
                <div class="form-group">
                  <button type="submit" class="btn btn--primary w-100 h-45">@lang('Submit')</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>

  <style>
    .checkbox-group {
      width: 100%;
      margin: 2px;
    }

    .checkbox-group input[type="checkbox"] {
      width: 100%;
    }
  </style>
