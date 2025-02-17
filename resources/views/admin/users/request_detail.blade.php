@extends('admin.layouts.app')
@section('panel')
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card b-radius--10">
                <div class="card-body">
                    @if($user->profile_change_request)
                                    @php
                                        $profileRequests = is_string($user->profile_change_request)
                                            ? json_decode($user->profile_change_request, true)
                                            : $user->profile_change_request;
                                    @endphp

                                    @if(is_array($profileRequests))
                                        <ul class="list-group">
                                            @foreach($profileRequests as $index => $val)
                                                @continue(empty($val['value']))
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    <strong>{{ __($val['name']) }}</strong>
                                                    <span>
                                                        @if($val['type'] == 'checkbox')
                                                            {{ implode(',', (array) $val['value']) }}
                                                        @elseif($val['type'] == 'file')
                                                            @if($val['value'])
                                                                @if (in_array(pathinfo($val['value'], PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                                                                    <div class="mt-2">
                                                                        <img src="{{ asset(getFilePath('verify') . '/' . $val['value']) }}" alt="Image Preview"
                                                                            class="img-fluid"
                                                                            style="width: 250px; height: 250px; object-fit: contain; cursor: pointer;"
                                                                            data-bs-toggle="modal" data-bs-target="#imageModal{{$index}}" />
                                                                        <div class="modal fade" id="imageModal{{$index}}" tabindex="-1"
                                                                            aria-labelledby="imageModalLabel{{$index}}" aria-hidden="true">
                                                                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title">@lang('Image Preview')</h5>
                                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                                            aria-label="Close"></button>
                                                                                    </div>
                                                                                    <div class="modal-body text-center">
                                                                                        <img src="{{ asset(getFilePath('verify') . '/' . $val['value']) }}"
                                                                                            alt="Large Image Preview"
                                                                                            class="img-fluid modal-image zoomable-image"
                                                                                            style="cursor: zoom-in;" />
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @elseif(pathinfo($val['value'], PATHINFO_EXTENSION) == 'pdf')
                                                                    <div class="mt-2">
                                                                        <a href="#" data-bs-toggle="modal" data-bs-target="#pdfModal{{$index}}">
                                                                            <i class="fa fa-file-pdf"></i> @lang('View PDF')
                                                                        </a>
                                                                        <div class="modal fade" id="pdfModal{{$index}}" tabindex="-1" aria-hidden="true">
                                                                            <div class="modal-dialog modal-xl modal-dialog-centered">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title">@lang('PDF Preview')</h5>
                                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                                            aria-label="Close"></button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <iframe src="{{ asset(getFilePath('verify') . '/' . $val['value']) }}"
                                                                                            width="100%" height="600px" style="border:none;"></iframe>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                                <a href="{{ route('admin.download.attachment', encrypt(getFilePath('verify') . '/' . $val['value'])) }}"
                                                                    class="me-3">
                                                                    <i class="fa fa-file"></i> @lang('Download')
                                                                </a>
                                                            @else
                                                                @lang('No File')
                                                            @endif
                                                        @else
                                                            <p>{{ __($val['value']) }}</p>
                                                        @endif
                                                    </span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <div class="alert alert-info">
                                            {{ __('Invalid profile data format') }}
                                        </div>
                                    @endif
                    @else
                        <h5 class="text-center">@lang('Request data not found')</h5>
                    @endif

                    @if($user->profile_request == 2)
                        <div class="d-flex flex-wrap justify-content-end mt-3">
                            <button class="btn btn-outline--danger me-3" data-bs-toggle="modal"
                                data-bs-target="#kycRejectionModal"><i class="las la-ban"></i>@lang('Reject')</button>
                            <button class="btn btn-outline--success confirmationBtn"
                                data-question="@lang('Are you sure to approve this Request?')"
                                data-action="{{ route('admin.users.request.approve', $user->id) }}"><i
                                    class="las la-check"></i>@lang('Approve')</button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div id="kycRejectionModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Reject Request')</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <form action="{{ route('admin.users.request.reject', $user->id) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="alert alert-primary p-3">
                            @lang('If you reject this Request will be replaced by new Request.')
                        </div>
                        <div class="form-group">
                            <label>@lang('Rejection Reason')</label>
                            <textarea class="form-control" name="reason" rows="4" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn--primary h-45 w-100">@lang('Submit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <x-confirmation-modal />
@endsection