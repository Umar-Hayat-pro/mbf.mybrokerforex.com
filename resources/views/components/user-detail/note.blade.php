<div class="row mb--20">
  <div class="col-lg-12">
      <div class="card mt-30">
          <div class="card-body">
              <label for="note">@lang('Add a Note')</label>
              <textarea id="note" class="form-control wysiwyg-editor" rows="10"></textarea>
          </div>

          <div class="card-footer text-end">
              <button type="submit" class="btn btn-primary">@lang('Save Note')</button>
          </div>
      </div>
  </div>
</div>

<x-confirmation-modal />

