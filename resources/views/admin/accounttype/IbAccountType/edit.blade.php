@extends('admin.layouts.app')

@section('panel')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="card b-radius--10">
            <div class="card-body">
                <form action="{{ isset($accountData) ? route('admin.ibaccounttype.update', $id) : route('admin.ibaccounttype.store') }}" method="POST">
                    @csrf
                    @if (isset($accountData))
                      @method('PUT')
                    @endif
                    <div class="form-group">
                        <label>@lang('Title')</label>
                        <input type="text" name="title" class="form-control" value="{{ $accountData['title'] ?? '' }}" required>
                    </div>
                    <div class="form-group">
                        <label>@lang('Group')</label>
                        <select name="group" class="form-control" required>
                            @foreach ($groupOptions as $option)
                                <option value="{{ $option }}" {{ isset($accountData) && $accountData['group'] == $option ? 'selected' : '' }}>
                                    {{ $option }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>@lang('IB Type')</label>
                        <select name="type" class="form-control" required>
                            @foreach ($ibTypeOptions as $option)
                                <option value="{{ $option }}" {{ isset($accountData) == $option ? 'selected' : '' }}>
                                    {{ $option }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>@lang('Badge')</label>
                        <input type="text" name="badge" class="form-control" value="{{ $accountData['badge'] ?? '' }}" required>
                    </div>
                    <div class="form-group">
                        <label>@lang('Status')</label>
                        <select name="status" class="form-control" required>
                            @foreach ($statusOptions as $option)
                                <option value="{{ $option }}" {{ isset($accountData) && $accountData['status'] == $option ? 'selected' : '' }}>
                                    {{ $option }}
                                </option>
                            @endforeach
                        </select>
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
      <a href="{{ route('admin.ibaccounttype.index') }}">
        <button class="btn btn--primary input-group-text"><i class="fa fa-arrow-left"></i> @lang('Back to List')</button>
      </a>
    </div>
  </div>
@endpush
