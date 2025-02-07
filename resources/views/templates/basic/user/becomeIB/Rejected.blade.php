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
          <!-- Icon -->
          <div class="my-4">
            <img src="{{ asset('assets/templates/basic/images/reject-icon-vector-10851097.jpg') }}" alt="Rejected Icon"
              width="60">
          </div>



          <!-- Heading -->
          <h3>@lang('Partner Request Rejected')</h3>

          <!-- Description -->
          <p class="mb-4">@lang('Your partnership request was rejected for some Reason for further information please contact our services team!')</p>

          <!-- Support -->
          <div class="d-flex justify-content-center gap-3">
            <p>
              @lang('If you face any issue, please visit our')
              <a {{-- href="{{ route('support.contact') }}" --}}>@lang('Customer Support')</a>
              @lang('or Email us at')
              <a href="mailto:support@mbfx.co">support@mbfx.co</a>.
            </p>
          </div>

          {{-- <!-- Support -->
          <div class="mt-4">
           
          </div> --}}

        </div>
      </div>
    </div>
  </div>
@endsection
