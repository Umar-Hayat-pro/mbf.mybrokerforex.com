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
        <div class="card-body text-center">

          <!-- Icon -->
          <div class="my-4">
            <img src="{{ asset('assets/templates/basic/images/pending-icon.png') }}" alt="Pending Icon"  width="90">
        </div>
        

          <!-- Heading -->
          <h3>@lang('Partner Request Pending')</h3>

          <!-- Description -->
          <p class="mb-4">@lang('Your partnership request is under review and we\'ll confirm with you shortly. Stay tuned!')</p>

          <!-- Buttons -->
          <div class="d-flex justify-content-center gap-3">
            <a 
            {{-- href="{{ route('partner.agreement') }}"  --}}
            class="btn btn--primary">
              @lang('Read Partner Agreement')
            </a>
            <a href="https://www.trustpilot.com/review/yourlink" class="btn btn--dark">
              @lang('Read Our Reviews On Trustpilot')
            </a>
          </div>

          <!-- Support -->
          <div class="mt-4">
            <p>
              @lang('If you face any issue, please visit our')
              <a 
              {{-- href="{{ route('support.contact') }}" --}}
              >@lang('Customer Support')</a>
              @lang('or Email us at')
              <a href="mailto:support@mbfx.co">support@mbfx.co</a>.
            </p>
          </div>

        </div>
      </div>
    </div>
  </div>
@endsection
