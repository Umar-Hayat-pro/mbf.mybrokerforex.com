@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card custom--card">
                    <div class="card-header">
                        <h5 class="card-title">@lang('Profile Change Request Form')</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('user.request.submit')}}" method="post" enctype="multipart/form-data">
                            @csrf

                            <x-viser-form identifier="act" identifierValue="UserProfile" />

                            <div class="form-group">
                                <button type="submit" class="btn btn--base w-100">@lang('Submit')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection