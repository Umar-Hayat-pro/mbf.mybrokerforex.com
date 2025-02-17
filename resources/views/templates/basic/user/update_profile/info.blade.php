@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card custom--card">
                    <div class="card-header">
                        <h5 class="card-title">@lang('User Profile Request Form')</h5>
                    </div>
                    <div class="card-body">
                        @if (!empty($user->profile_change_request) && is_iterable($user->profile_change_request))
                            <ul class="list-group list-group-flush">
                                @foreach($user->profile_change_request as $val)
                                    @continue(empty($val->value)) {{-- Skip if value is empty --}}
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        {{ __($val->name) }}
                                        <span>
                                            @if($val->type == 'checkbox' && is_array($val->value))
                                                {{ implode(',', $val->value) }}
                                            @elseif($val->type == 'file')
                                                <a href="{{ route('user.attachment.download', encrypt(getFilePath('verify') . '/' . $val->value)) }}"
                                                    class="me-3">
                                                    <i class="fa fa-file"></i> @lang('Attachment')
                                                </a>
                                            @else
                                                <p>{{ __($val->value) }}</p>
                                            @endif
                                        </span>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <h5 class="text-center">@lang('User Request data not found')</h5>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection