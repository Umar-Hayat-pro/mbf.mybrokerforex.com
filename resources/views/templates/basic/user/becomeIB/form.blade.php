@extends($activeTemplate . 'layouts.master')

@section('content')
  <div class="row gy-4 justify-content-center">
    <div class="col-12">
      <div class="dashboard-header-menu justify-content-between align-items-center">
        <h4 class="mb-0">{{ __($pageTitle) }}</h4>
      </div>
    </div>
    <div class="col-12">
      <div class="card b-radius--10">
        <div class="card-body">
          <form action="{{ isset($accountData) ? route('become_ib.update', $accountData['user_id']) : route('admin.store_user') }}" method="POST">
            @csrf
            @if (isset($accountData))
                @method('PUT')
            @endif
            
            <div class="form-group">
              <h3>@lang('Become A Introducing Broker')</h3>
              <p>Make sure your details are correct - after applying, we will reach out to discuss your experience. We
                will also answer any questions you might have.</p>
            </div>

            <div class="form-group">
              <label>@lang('Which Country Do You Plan To Target As Part of Our IB Partner Program?')</label>
              <select name="country" class="form-control" required>
                <option value="">Select a country</option>
                @foreach ($countryOptions as $option)
                  <option value="{{ $option }}"
                    {{ isset($accountData) && $accountData['country'] == $option ? 'selected' : '' }}>
                    {{ $option }}
                  </option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <label>@lang('How Do You Attract Your Clients? Select All Possible Answers.')</label>
              <div>
                @foreach ($selectableOptions as $option)
                  <div class="form-check">
                    <input type="checkbox" name="selectable_options[]" value="{{ $option }}"
                      id="option_{{ $loop->index }}" class="form-check-input"
                      {{ isset($accountData) && in_array($option, json_decode($accountData['options'], true)) ? 'checked' : '' }}>
                    <label class="form-check-label" for="option_{{ $loop->index }}">
                      {{ $option }}
                    </label>
                  </div>
                @endforeach
              </div>
            </div>

            <div class="form-group">
              <label>@lang('What is The Background Of Majority Of Your Clients? Select All Possible Answers!')</label>
              <div>
                @foreach ($brokerBackground as $option)
                  <div class="form-check">
                    <input type="checkbox" name="background_options[]" value="{{ $option }}"
                      id="background_{{ $loop->index }}" class="form-check-input"
                      {{ isset($accountData) && in_array($option, json_decode($accountData['background_options'], true)) ? 'checked' : '' }}>
                    <label class="form-check-label" for="background_{{ $loop->index }}">
                      {{ $option }}
                    </label>
                  </div>
                @endforeach
              </div>
            </div>



            <div class="form-group">
              <label>@lang('How Many Clients Do You Expect To Acquire In The First 3 Months of Our Partnership?')</label>
              <input type="text" name="expected_clients" class="form-control"
                value="{{ $accountData['expected_clients'] ?? '' }}" required>
            </div>

            <div class="form-group">
              <label>@lang('How Do You Plan To Market Your Services?')</label>
              <select name="services" class="form-control" required>
                <option value="">Select a Service</option>
                <option value="Social Media"
                  {{ isset($accountData) && $accountData['services'] == 'Social Media' ? 'selected' : '' }}>Social Media
                </option>
                <option value="Email Marketing"
                  {{ isset($accountData) && $accountData['services'] == 'Email Marketing' ? 'selected' : '' }}>Email
                  Marketing</option>
              </select>
            </div>

            <div class="form-group">
              <label>@lang('How Many Active Clients Do You Have?')</label>
              <input type="text" name="active_clients" class="form-control"
                value="{{ $accountData['active_clients'] ?? '' }}" required>
            </div>

            <div class="form-group">
              <label>@lang('What Was Your Trading Volume (In Standard Lots) In The Past Three Months?')</label>
              <input type="text" name="trading_volume" class="form-control"
                value="{{ $accountData['trading_volume'] ?? '' }}" required>
            </div>

            <div class="form-group">
              <div class="form-check">
                <input type="checkbox" name="terms_agreement" value="1" class="form-check-input"
                  {{ isset($accountData) && $accountData['terms_agreement'] == '1' ? 'checked' : '' }} required>
                <label class="form-check-label">@lang('I Have Read & Agreed To The Terms Stated Above')</label>
              </div>
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn--base outline btn--sm trade-btn">
                  @if (isset($accountData))
                      @lang('Update')
                  @else
                      @lang('Create')
                  @endif
              </button>
          </div>
          
          {{-- Debugging output (optional) --}}
          @if (isset($accountData))
              <pre>{{ dd($accountData) }}</pre>
          @endif
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('breadcrumb-plugins')
  <div class="d-inline">
    <div class="input-group justify-content-end">
      <a href="{{ route('admin.ibaccounttype.index') }}">
        <button class="btn btn--primary input-group-text"><i class="fa fa-arrow-left"></i> @lang('Back to List')</button>
      </a>
    </div>
  </div>
@endpush
