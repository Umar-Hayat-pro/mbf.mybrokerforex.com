@extends('admin.layouts.app')
@section('panel')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="card b-radius--10">
            <div class="card-body">
                @if($user->kyc_data)
                    <ul class="list-group">
                        @foreach($user->kyc_data as $index => $val)
                            @continue(!$val->value)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{__($val->name)}}
                                <span>
                                    @if($val->type == 'checkbox')
                                        {{ implode(',', $val->value) }}
                                    @elseif($val->type == 'file')
                                        @if($val->value)
                                            @if (in_array(pathinfo($val->value, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                                                <div class="mt-2">
                                                    <img src="{{ asset(getFilePath('verify') . '/' . $val->value) }}" alt="Image Preview"
                                                        class="img-fluid"
                                                        style="width: 250px; object-fit: contain; height: 250px; cursor: pointer;"
                                                        data-bs-toggle="modal" data-bs-target="#imageModal{{$index}}" />
                                                    <div class="modal fade" id="imageModal{{$index}}" tabindex="-1"
                                                        aria-labelledby="imageModalLabel{{$index}}" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="imageModalLabel{{$index}}">Image Preview
                                                                    </h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body text-center">
                                                                    <img src="{{ asset(getFilePath('verify') . '/' . $val->value) }}"
                                                                        alt="Large Image Preview"
                                                                        class="img-fluid modal-image zoomable-image"
                                                                        id="zoomImage{{$index}}" style="cursor: zoom-in;" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @elseif(pathinfo($val->value, PATHINFO_EXTENSION) == 'pdf')
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
                                                                    <iframe src="{{ asset(getFilePath('verify') . '/' . $val->value) }}"
                                                                        width="100%" height="600px" style="border:none;"></iframe>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            <a href="{{ route('admin.download.attachment', encrypt(getFilePath('verify') . '/' . $val->value)) }}"
                                                class="me-3">
                                                <i class="fa fa-file"></i> @lang('Download')
                                            </a>
                                        @else
                                            @lang('No File')
                                        @endif
                                    @else
                                        <p>{{__($val->value)}}</p>
                                    @endif
                                </span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <h5 class="text-center">@lang('KYC data not found')</h5>
                @endif


                @if($user->kv == Status::KYC_UNVERIFIED)
                    <div class="my-3">
                        <h6>@lang('Rejection Reason')</h6>
                        <p>{{ $user->kyc_rejection_reason }}</p>
                    </div>
                @endif

                @if($user->kv == Status::KYC_PENDING)
                    <div class="d-flex flex-wrap justify-content-end mt-3">
                        <button class="btn btn-outline--danger me-3" data-bs-toggle="modal"
                            data-bs-target="#kycRejectionModal"><i class="las la-ban"></i>@lang('Reject')</button>
                        <button class="btn btn-outline--success confirmationBtn"
                            data-question="@lang('Are you sure to approve this documents?')"
                            data-action="{{ route('admin.users.kyc.approve', $user->id) }}"><i
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
                <h5 class="modal-title">@lang('Reject KYC Documents')</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="las la-times"></i>
                </button>
            </div>
            <form action="{{ route('admin.users.kyc.reject', $user->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="alert alert-primary p-3">
                        @lang('If you reject these documents, the user will be able to re-submit new documents and these documents will be replaced by new documents.')
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