<div class="row mb--20">
  <div class="col-lg-12">
    <div class="card mt-30">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">@lang('Direct referrals of') {{ $user->fullname }}</h5>
        <button class="btn btn--primary" data-bs-toggle="modal" data-bs-target="#referralModal">
          <i class="fa fa-plus"></i> @lang('Add Referral')
        </button>

      </div>

      <div class="card-body p-0">
        <div class="table-responsive--sm table-responsive">
          <table class="table table--light style--two custom-data-table">
            <thead>
              <tr>
                <th>@lang('First Name')</th>
                <th>@lang('Last Name')</th>
                <th>@lang('Email')</th>
              </tr>
            </thead>
            <tbody>

            <tbody>
              @if ($referrer)
          <tr>
          <td>{{ $referrer->firstname }}</td>
          <td>{{ $referrer->lastname }}</td>
          <td>{{ $referrer->email }}</td>
          </tr>
        @else
        <tr>
        <td colspan="7" class="text-center">@lang('No referrals found')</td>
        </tr>
      @endif
            </tbody>
          </table>
        </div>
      </div>
      <div class="card-footer">
        {{-- {{ $paginator->links() }} --}}
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="referralModal" tabindex="-1" aria-labelledby="addReferralModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content add-referral-modal">
      <!-- Header -->
      <div class="modal-header add-referral-header">
        <h5 class="modal-title add-referral-title" id="addReferralModalLabel">Add Direct Referral</h5>
        <button type="button" class="btn-close add-referral-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- Body -->
      <div class="modal-body add-referral-body">
        <div class="add-referral-user-details">
          <p class="add-referral-user-name">{{ $user->full_name }}</p>
          <p class="add-referral-question">Are you sure you want to add a referral for this user?</p>
        </div>

        <form action="{{ route('admin.users.referral.add', $user->id) }}" method="post">
          @csrf

          <!-- Referral Select -->
          <div class="mb-3 add-referral-form-group">
            <label for="addReferralUser" class="form-label add-referral-label">Select a Referral User:</label>
            <select id="addReferralUser" name="referral_user" class="form-control add-referral-select">
              <option value="" disabled selected>Choose a user</option>
              @foreach($allUsers as $u)
          <option value="{{ $u->id }}" data-name="{{ $u->full_name }}" data-email="{{ $u->email }}">
          {{ $u->full_name }} ({{ $u->email }})
          </option>
        @endforeach
            </select>
          </div>

          <!-- Footer Buttons -->
          <div class="modal-footer add-referral-footer">
            <button type="button" class="btn add-referral-btn-cancel" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn add-referral-btn-approve">Approve</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>



<x-confirmation-modal />


@push('script')
  <script>
    $(document).ready(function () {
    function customMatcher(params, data) {
      if ($.trim(params.term) === '') return data;

      if (data.element) {
      let name = $(data.element).data('name') || '';
      let email = $(data.element).data('email') || '';

      if (name.toLowerCase().includes(params.term.toLowerCase()) ||
        email.toLowerCase().includes(params.term.toLowerCase())) {
        return data;
      }
      }
      return null;
    }

    $('#referralUser').select2({
      width: '100%',
      placeholder: 'Search by name or email...',
      allowClear: true,
      matcher: customMatcher
    });
    });
  </script>
@endpush

<!-- Custom Styling -->
<style>
  /* Modal Container */
  .add-referral-modal {
    background-color: #ffffff;

    color: #333;
    border-radius: 12px;
    border: 1px solid #ddd;
    box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
  }

  /* Header */
  .add-referral-header {
    background: #d32f2f;
    color: white;
    border-top-left-radius: 12px;
    border-top-right-radius: 12px;
    padding: 15px;
  }

  .add-referral-title {
    font-size: 20px;
    font-weight: bold;
  }


  .add-referral-close {
    filter: invert(0);
    opacity: 0.7;
  }

  .add-referral-close:hover {
    opacity: 1;
  }

  .add-referral-body {
    padding: 20px;
  }


  .add-referral-user-details {
    text-align: center;
    margin-bottom: 15px;
  }

  .add-referral-user-name {
    font-size: 22px;
    font-weight: bold;
    color: #d32f2f;
  }

  .add-referral-question {
    font-size: 16px;
    color: #666;
  }

  .add-referral-label {
    font-weight: bold;
    color: #d32f2f;
  }

  .add-referral-select {
    background: #f9f9f9;
    border-radius: 8px;
    border: 1px solid #ccc;
    padding: 10px;
    color: #333;
    width: 100%;
  }

  .add-referral-select:focus {
    background: #fff;
    border-color: #d32f2f;
    box-shadow: 0 0 5px rgba(211, 47, 47, 0.5);
  }

  /* Footer Buttons */
  .add-referral-footer {
    justify-content: space-between;
    padding: 15px;
  }

  /* Cancel Button */
  .add-referral-btn-cancel {
    background: #f1f1f1;
    color: #333;
    border-radius: 8px;
    padding: 10px 18px;
    border: none;
    transition: all 0.3s ease-in-out;
  }

  .add-referral-btn-cancel:hover {
    background: #e1e1e1;
  }

  /* Approve Button */
  .add-referral-btn-approve {
    background: #d32f2f;
    color: white;
    border-radius: 8px;
    padding: 10px 18px;
    border: none;
    transition: all 0.3s ease-in-out;
  }

  .add-referral-btn-approve:hover {
    background: #b71c1c;
  }

  /* Dropdown Styling */
  .add-referral-select {
    cursor: pointer;
  }
</style>