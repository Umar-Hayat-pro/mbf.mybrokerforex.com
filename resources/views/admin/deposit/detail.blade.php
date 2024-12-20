@extends('admin.layouts.app')
@section('panel')
    <div class="row mb-none-30 justify-content-center">
        <div class="col-xl-4 col-md-6 mb-30">
            <div class="card b-radius--10 overflow-hidden box--shadow1">
                <div class="card-body">
                    <h5 class="mb-20 text-muted">@lang('Deposit Via') {{ __(@$deposit->gateway->name) }}</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Date')
                            <span class="fw-bold">{{ showDateTime($deposit->created_at) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Transaction Number')
                            <span class="fw-bold">{{ $deposit->trx }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Username')
                            <span class="fw-bold">
                                <a
                                    href="{{ route('admin.users.detail', $deposit->user_id) }}">{{ @$deposit->user->username }}</a>
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Method')
                            <span class="fw-bold">{{ __(@$deposit->gateway->name) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Amount')
                            <span class="fw-bold">{{ showAmount($deposit->amount) }}
                                {{ __($deposit->method_currency) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Charge')
                            <span class="fw-bold">{{ showAmount($deposit->charge) }}
                                {{ __($deposit->method_currency) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('After Charge')
                            <span class="fw-bold">{{ showAmount($deposit->amount + $deposit->charge) }}
                                {{ __($deposit->method_currency) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Payable')
                            <span class="fw-bold">{{ showAmount($deposit->final_amount) }}
                                {{ __($deposit->method_currency) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Status')
                            @php echo $deposit->statusBadge @endphp
                        </li>
                        @if ($deposit->admin_feedback)
                            <li class="list-group-item">
                                <strong>@lang('Admin Response')</strong>
                                <br>
                                <p>{{ __($deposit->admin_feedback) }}</p>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>


        @if ($details || $deposit->status == Status::PAYMENT_PENDING)
        <div class="col-xl-8 col-md-6 mb-30">
            <div class="card b-radius--10 overflow-hidden box--shadow1">
                <div class="card-body">
                    <h5 class="card-title mb-50 border-bottom pb-2">@lang('User Deposit Information')</h5>
                    
                    @if ($details != null)
                        @foreach (json_decode($details) as $val)
                            @if ($deposit->method_code >= 1000)
                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <h6>{{ __($val->name) }}</h6>
                                        @if ($val->type == 'checkbox')
                                            {{ implode(',', $val->value) }}
                                        @elseif($val->type == 'file')
                                            @if ($val->value)
                                                <!-- Preview image in one column -->
                                                @if (in_array(pathinfo($val->value, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                                                    <div class="mt-2">
                                                        <img src="{{ asset(getFilePath('verify') . '/' . $val->value) }}"
                                                            alt="Image Preview" class="img-fluid"
                                                            style="width: 100%; object-fit: contain; height: 250px; cursor: pointer;"
                                                            data-bs-toggle="modal" data-bs-target="#imageModal" />
                                                            
                                                        <!-- Bootstrap Modal for larger image preview with zoom functionality -->
                                                        <div class="modal fade" id="imageModal" tabindex="-1"
                                                            aria-labelledby="imageModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="imageModalLabel">Image Preview</h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body text-center">
                                                                        <img src="{{ asset(getFilePath('verify') . '/' . $val->value) }}"
                                                                            alt="Large Image Preview"
                                                                            class="img-fluid modal-image zoomable-image"
                                                                            id="zoomImage" style="cursor: zoom-in;" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @else
                                                @lang('No File')
                                            @endif
                                        @else
                                            <p>{{ __($val->value) }}</p>
                                        @endif
                                    </div>
                                    
                                    <!-- Buttons and links in the second column -->
                                    <div class="col-md-6 d-flex flex-column gap-1 justify-content-center  mt-auto">
                                        <a href="{{ route('admin.download.attachment', encrypt(getFilePath('verify') . '/' . $val->value)) }}"
                                           class="me-3"><i class="fa fa-file"></i> @lang('Attachment') </a>
                                        @if ($deposit->status == Status::PAYMENT_PENDING)
                                            <button class="btn btn-outline--success btn-sm ms-1 confirmationBtn"
                                                data-action="{{ route('admin.deposit.approve', $deposit->id) }}"
                                                data-question="@lang('Are you sure to approve this transaction?')">
                                                <i class="las la-check-double"></i> @lang('Approve')
                                            </button>
    
                                            <button class="btn btn-outline--danger btn-sm ms-1 rejectBtn" data-id="{{ $deposit->id }}"
                                                data-info="{{ $details }}"
                                                data-amount="{{ showAmount($deposit->amount) }} {{ __($general->cur_text) }}"
                                                data-username="{{ @$deposit->user->username }}">
                                                <i class="las la-ban"></i> @lang('Reject')
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif
    
                    @if ($deposit->method_code < 1000)
                        @include('admin.deposit.gateway_data', ['details' => json_decode($details)])
                    @endif
    
                </div>
            </div>
        </div>
    @endif
    

    {{-- REJECT MODAL --}}
    <div id="rejectModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Reject Deposit Confirmation')</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <form action="{{ route('admin.deposit.reject') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        <p>@lang('Are you sure to') <span class="fw-bold">@lang('reject')</span> <span
                                class="fw-bold withdraw-amount text-success"></span> @lang('deposit of') <span
                                class="fw-bold withdraw-user"></span>?</p>

                        <div class="form-group">
                            <label class="mt-2">@lang('Reason for Rejection')</label>
                            <textarea name="message" maxlength="255" class="form-control" rows="5" required>{{ old('message') }}</textarea>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn--primary w-100 h-45">@lang('Submit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-xl-12 col-md-12">
            <div class="card b-radius--10 box--shadow1">
                <div class="card-body">
                    <!-- Card Title -->
                    <h5 class="card-title">@lang('Comments')</h5>

                    <!-- Add Comment Form -->
                    <form action="{{ route('admin.deposit.comment', $deposit->id) }}" method="POST" class="mb-4">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="comment">@lang('Add a Comment')</label>
                            <textarea name="comment" id="comment" class="form-control" rows="3" placeholder="@lang('Write your comment...')"
                                required></textarea>
                        </div>
                        <button type="submit" class="btn btn--primary w-100">@lang('Submit Comment')</button>
                    </form>

                    <!-- Comments History Section -->
                    <div class="comment-section mt-5">
                        <h6 class="mb-4">@lang('Comments History')</h6>
                        @php
                            // Decode the comments JSON if it's not already an array
                            $comments = json_decode($deposit->comment, true);
                        @endphp

                        @if (is_array($comments) && count($comments) > 0)
                            @foreach ($comments as $comment)
                                @if (trim($comment))
                                    <!-- Ensure to skip empty comments -->
                                    <div class="comment-box mb-3 p-3 border rounded">
                                        <p>{{ $comment }}</p>
                                    </div>
                                @endif
                            @endforeach
                        @else
                            <p>@lang('No comments yet.')</p>
                        @endif
                    </div>


                </div>
            </div>
        </div>
    </div>








    <x-confirmation-modal />
@endsection

@push('style')
    <style>
        .zoomable-image {
            transition: transform 0.3s ease;
            /* Smooth zooming transition */
        }
    </style>
@endpush


@push('script')
    <script>
        (function($) {
            "use strict";

            $('.rejectBtn').on('click', function() {
                var modal = $('#rejectModal');
                modal.find('input[name=id]').val($(this).data('id'));
                modal.find('.withdraw-amount').text($(this).data('amount'));
                modal.find('.withdraw-user').text($(this).data('username'));
                modal.modal('show');
            });
        })(jQuery);


        document.addEventListener('DOMContentLoaded', function() {
            const zoomImage = document.getElementById('zoomImage');

            zoomImage.addEventListener('click', function() {
                // Toggle between zoom-in and zoom-out
                if (zoomImage.style.transform === 'scale(1.5)') {
                    zoomImage.style.transform = 'scale(1)';
                    zoomImage.style.cursor = 'zoom-in'; // Change cursor back to zoom-in
                } else {
                    zoomImage.style.transform = 'scale(1.5)';
                    zoomImage.style.cursor = 'zoom-out'; // Change cursor to zoom-out
                }
            });
        });
    </script>
@endpush
