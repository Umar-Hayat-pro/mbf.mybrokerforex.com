@extends('admin.layouts.app')

@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">@lang('Add Country to Blacklist')</h5>
                    <form action="{{ route('admin.blacklist.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="country">@lang('Select Country')</label>
                            <select name="country" id="country" class="form-control" required>
                                <option value="">@lang('Select a country')</option>
                                @foreach ($availableCountries as $country)
                                    <option value="{{ $country['name'] }}">{{ $country['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn--primary">@lang('Add to Blacklist')</button>
                    </form>
                </div>
            </div><!-- card end -->
        </div>
    </div>
@endsection
