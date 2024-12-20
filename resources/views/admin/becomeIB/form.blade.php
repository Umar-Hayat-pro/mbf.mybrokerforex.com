@extends('admin.layouts.app')

@section('panel')
  <div class="row justify-content-center">
    <div class="col-lg-10">
      <div class="card b-radius--10">
        <div class="card-body">
          <form 
          {{-- action="{{ isset($accountData) ? route('admin.ibaccounttype.update', $index) : route('admin.ibaccounttype.store') }}"  --}}
           action="{{ isset($accountData) ? route('admin.update_ib', $index) : route('admin.store_ib') }}"
          method="POST">
            @csrf
            @if (isset($accountData))
              @method('PUT')
            @endif
            <div class="form-group">
              <h3>@lang('Become A Introducing Broker')</h3>
              <p name="title">Make sure your details are correct - after applying, we will reach out to discuss your experience. We will also answer any questions you might have.</p>
            </div>

            <div class="form-group">
              <label>@lang('Which Country Do You Plan To Target As Part of Our IB Partner Program?')</label>
              <select name="selectableCountry" class="form-control" required>
                <option value="">Select a country</option>
                {{-- @foreach ($countryOptions as $option) --}}
                  <option 
                  {{-- value="{{ $option }}"  --}}
                  {{ isset($accountData) && $accountData['country'] == $option ? 'selected' : '' }}>
                    {{-- {{ $option }} --}}
                  </option>
                {{-- @endforeach --}}
              </select>
            </div>

            <div class="form-group">
              <label>@lang('How Do You Attract Your Clients? Select All Possible Answers.')</label>
              <div>
                {{-- @foreach ($optionsToSelect as $option) --}}
                  <div class="form-check">
                    <input type="checkbox" name="options[]" 
                    {{-- value="{{ $option }}"
                     id="option_{{ $loop->index }}"
                      class="form-check-input" {{ isset($accountData) && in_array($option, $accountData['options']) ? 'checked' : '' }}
                  --}}>
                    <label class="form-check-label" 
                    {{-- for="option_{{ $loop->index }}" --}}
                    >
                      {{-- {{ $option }} --}}
                    </label>
                  </div>
                {{-- @endforeach --}}
              </div>
            </div>

            <div class="form-group">
              <label>@lang('What is The Background Of Majority Of Your Clients? Select All Possible Answers!')</label>
              <div>
                {{-- @foreach ($backgroundOfBroker as $option) --}}
                  <div class="form-check">
                    <input type="checkbox" name="options[]"
                     {{-- value="{{ $option }}" id="background_{{ $loop->index }}"  --}}
                     class="form-check-input" 
                     {{-- {{ isset($accountData) && in_array($option, $accountData['options']) ? 'checked' : '' }} --}}
                     >
                    <label class="form-check-label" 
                    {{-- for="background_{{ $loop->index }}" --}}
                    >
                      {{-- {{ $option }} --}}
                    </label>
                  </div>
                {{-- @endforeach --}}
              </div>
            </div>

            <div class="form-group">
              <label>@lang('How Many Clients Do You Expect To Acquire In The First 3 Months of Our Partnership?')</label>
              <input type="text" name="expected_clients" class="form-control" required>
            </div>

            <div class="form-group">
              <label>@lang('How Do You Plan To Market Your Services?')</label>
              <select name="services" class="form-control" required>
                <option value="">Select a Service</option>
                <option value="Social Media" {{ isset($accountData) && $accountData['services'] == 'Social Media' ? 'selected' : '' }}>Social Media</option>
                <option value="Email Marketing" {{ isset($accountData) && $accountData['services'] == 'Email Marketing' ? 'selected' : '' }}>Email Marketing</option>
              </select>
            </div>

            <div class="form-group">
              <label>@lang('How Many Active Clients Do You Have?')</label>
              <input type="text" name="active_clients" class="form-control" required>
            </div>

            <div class="form-group">
              <label>@lang('What Was Your Trading Volume (In Standard Lots) In The Past Three Months?')</label>
              <input type="text" name="trading_volume" class="form-control" required>
            </div>

            <div class="form-group">
              <div class="form-check">
                <input type="checkbox" name="terms_agreement" value="I Have Read & Agreed To The Terms Stated Above" class="form-check-input" required>
                <label class="form-check-label">@lang('I Have Read & Agreed To The Terms Stated Above')</label>
              </div>
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn--primary btn-block">
                @if (isset($accountData))
                  @lang('Update')
                @else
                  @lang('Create')
                @endif
              </button>
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
      <a href="{{ route('admin.form_ib') }}">
        <button class="btn btn--primary input-group-text"><i class="fa fa-arrow-left"></i> @lang('Back to List')</button>
      </a>
    </div>
  </div>
@endpush
