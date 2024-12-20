<div class="row mb--20">
  <div class="col-lg-12">
    <div class="card mt-30">
      <div class="card-body">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="card-title mb-0">@lang('Change password')</h5>
        </div>
        <br>
        <div class="row">
          <div class="col-md-6">
            <div class="mb-3">
              <label for="password" class="form-label">@lang('New Password:')</label>
              <input type="password" id="password" name="password" class="form-control" required>
            </div>
          </div>

          <div class="col-md-6">
            <div class="mb-3">
              <label for="confirm-password" class="form-label">@lang('Confirm Password:')</label>
              <input type="password" id="confirm-password" name="password_confirmation" class="form-control" required>
            </div>
          </div>
        </div>
      </div>

      <div class="card-footer text-end">
        <button type="submit" class="btn btn--primary">@lang('Change Password')</button>
      </div>
    </div>
  </div>
</div>

<x-confirmation-modal />
