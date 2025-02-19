<div class="row mb--20">
  <div class="col-lg-12">
    <div class="card mt-30">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">@lang('IB Account')</h5>
        <div>
          <button class="btn btn--primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="fa fa-plus"></i> @lang('Add New IB')
          </button>

          <!-- <a href="#" class="btn btn--primary">
            <i class="fa fa-plus"></i> @lang('Update IB')
          </a>
          <a href="#" class="btn btn--primary">
            <i class="fa fa-plus"></i> @lang('Add New Multi IB')
          </a>
          <a href="#" class="btn btn--primary">
            <i class="fa fa-plus"></i> @lang('Update Multi IB')
          </a> -->
        </div>
      </div>
      <div class="card-body p-0">
        <div class="table-responsive--sm table-responsive">
          <table class="table table--light style--two custom-data-table">
            <thead>
              <tr>
                <th>@lang('Login')</th>
                <th>@lang('Name')</th>
                <th>@lang('Group')</th>
                <th>@lang('Balance')</th>
              </tr>
            </thead>
            <tbody>
              @forelse($ibaccount as $ib)
          <tr>
          <td>@lang($ib->Login)</td>
          <td>@lang($ib->Name)</td>
          <td>@lang($ib->Group)</td>
          <td>@lang($ib->Balance)</td>
          </tr>
        @empty
        <tr>
        <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
        </tr>
      @endforelse
            </tbody>
          </table>
        </div>
      </div>
      {{--@if($ibaccount->hasPages())
      <div class="card-footer">
        {{ paginateLinks($accounts)}}
      </div>
      @endif
      --}}
    </div>
  </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md"> <!-- You can change modal-md to modal-lg if needed -->
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirm IB Approval</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <p class="user-name"> {{ $user->full_name }}</p>
        <p class="question">Do you want to make this user an IB?</p>

        <form action="{{ route('admin.become_ib.createAccount', $user->id) }}" method="post">
          @csrf
          <div class="modal-footer">
            <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-approve">Approve</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


<x-confirmation-modal />

<style>
  /* Modal Header */
  .modal-header {
    background-color: #f8f9fa;
    /* Light background color */
    text-align: center;
    /* Center-align title */
  }

  .modal-title {
    color: #343a40;
    /* Dark color for title */
    font-weight: bold;
  }

  /* Modal Body */
  .modal-body {
    text-align: center;
    /* Center the text */
    font-size: 1.1rem;
  }

  .user-name {
    font-size: 1.2rem;
    color: #007bff;
    /* Blue color for user's name */
  }

  .question {
    font-size: 1rem;
    margin-top: 10px;
    color: #495057;
    /* Dark gray for the question */
  }

  /* Modal Footer */
  .modal-footer {
    display: flex;
    justify-content: center;
    /* Center-align buttons */
    gap: 10px;
  }

  /* Buttons Styling */
  .btn-cancel {
    background-color: #6c757d;
    /* Gray background */
    color: white;
    border: none;
    padding: 10px 20px;
    font-size: 1rem;
    cursor: pointer;
  }

  .btn-cancel:hover {
    background-color: #5a6268;
    /* Darker gray on hover */
  }

  .btn-approve {
    background-color: #28a745;
    /* Green background for approve */
    color: white;
    border: none;
    padding: 10px 20px;
    font-size: 1rem;
    cursor: pointer;
  }

  .btn-approve:hover {
    background-color: #218838;
    /* Darker green on hover */
  }

  /* Optional: Modal background overlay */
  .modal-backdrop {
    background-color: rgba(0, 0, 0, 0.5);
  }
</style>