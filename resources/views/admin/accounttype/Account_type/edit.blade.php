@extends('admin.layouts.app')

@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10">
                <div class="card-header">
                    <h4 class="card-title">
                        @if (isset($accountType))
                            @lang('Edit Account Type')
                        @else
                            @lang('Create Account Type')
                        @endif
                    </h4>
                </div>


                <div class="card-body">
                    <form
                        action="{{ isset($accountType) ? route('admin.accounttype.update', $accountType->id) : route('admin.accounttype.store') }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @if (isset($accountType))
                            @method('PUT')
                        @endif

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title">@lang('Title')</label>
                                    <input type="text" name="title" id="title" placeholder="Account Title"
                                        class="form-control"
                                        value="{{ isset($accountType) ? $accountType->title : old('title') }}" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="priority">@lang('Priority')</label>
                                    <input type="number" name="priority" id="priority" placeholder="1,2,3..eg"
                                        class="form-control"
                                        value="{{ isset($accountType) ? $accountType->priority : old('priority') }}"
                                        required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="priority">@lang('Initial Deposit')</label>
                                    <input type="number" name="deposit" id="deposit" placeholder="10,20,30..eg"
                                        class="form-control"
                                        value="{{ $accountType->initial_deposit ?? old('initial_deposit') }}" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="leverage">@lang('Leverage')</label>
                                    <input type="text" name="leverage" id="leverage"
                                        placeholder="leverage eg.10,20,30..." class="form-control"
                                        value="{{ isset($accountType) ? $accountType->leverage : old('leverage') }}"
                                        required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="country">@lang('Country')</label>
                                    <select name="country[]" id="country" class="form-control select2-multiple"
                                        multiple="multiple" required>
                                        @php
                                            // If editing, get selected countries from the accountType, otherwise use old() data or an empty array
                                            $selectedCountries = isset($accountType)
                                                ? json_decode($accountType->country, true) // Decode JSON stored in DB
                                                : old('country', []); // Fallback to old() for validation errors
                                        @endphp


                                        @foreach ($countryList as $country)
                                            <option value="{{ $country }}"
                                                {{ in_array($country, $selectedCountries) ? 'selected' : '' }}>
                                                {{ $country }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="spread">@lang('Spread')</label>
                                    <input type="text" name="spread" id="spread" placeholder="0.1,0.2,0.3..eg"
                                        class="form-control" value="{{ $accountType->spread ?? old('spread') }}" required>
                                </div>
                            </div>


                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="badge">@lang('Badge')</label>
                                    <input type="text" name="badge" id="badge" class="form-control"
                                        value="{{ isset($accountType) ? $accountType->badge : old('badge') }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status">@lang('Status')</label>
                                    <select name="status" id="status" class="form-control" required>
                                        <option value="Active"
                                            {{ isset($accountType) && $accountType->status == 'Active' ? 'selected' : '' }}>
                                            @lang('Active')</option>
                                        <option value="Inactive"
                                            {{ isset($accountType) && $accountType->status == 'Inactive' ? 'selected' : '' }}>
                                            @lang('Inactive')</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="badge">@lang('Add a Description')</label>
                                    <input type="text" name="description" id="description" class="form-control" required
                                        value="{{ isset($accountType) ? $accountType->description : old('description') }}" />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="badge">@lang('Account Type Commision')</label>
                                    <input type="text" name="commision" id="commision" class="form-control" required
                                        value="{{ isset($accountType) ? $accountType->commision : old('commision') }}" />
                                </div>
                            </div>
                        </div>

                        <div class="card">

                            <div class="row">
                                <!-- Live Account -->
                                <div class="col-md-6">
                                    <div class="card b-radius--10 mb-4">
                                        <div class="card-header">
                                            <h4 class="card-title">@lang('Live Account')</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="livePlatformGroup">@lang('Platform Group')</label>
                                                <input type="text" id="livePlatformGroup" class="form-control"
                                                    name="liveAccount"
                                                    value="{{ isset($accountType) ? $accountType->live_account : old('live_account') }}">
                                            </div>
                                            <div class="form-group">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="liveSwapFree"
                                                        name="liveSwapFree" value="1"
                                                        {{ old('liveSwapFree', isset($accountType) && $accountType->live_islamic == 1 ? 'checked' : 0) }}>
                                                    <label class="form-check-label"
                                                        for="liveSwapFree">@lang('Enable Separate Swap-Free (Islamic) Account Type')</label>
                                                </div>
                                            </div>
                                            <div class="form-group" id="liveIslamicPlatformGroupContainer">
                                                <label for="liveIslamicPlatformGroup">@lang('Platform Group')</label>
                                                <input type="text" id="liveIslamicPlatformGroup" class="form-control"
                                                    name="liveIslamicInput"
                                                    value="{{ isset($accountType) ? $accountType->live_islamic_input : old('live_islamc_input') }}">
                                            </div>
                                            <div class="form-group">
                                                <label>@lang('Trading Server (Live)')</label>
                                                <input type="text" class="form-control" value="MT5 Server" readonly disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Demo Account -->
                                <div class="col-md-6">
                                    <div class="card b-radius--10 mb-4">
                                        <div class="card-header">
                                            <h4 class="card-title">@lang('Demo Account')</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="demoPlatformGroup">@lang('Platform Group')</label>
                                                <input type="text" id="demoPlatformGroup" class="form-control"
                                                    name="demoAccount"
                                                    value="{{ isset($accountType) ? $accountType->demo_account : old('demo_account') }}">
                                            </div>
                                            <div class="form-group">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="demoSwapFree"
                                                        name="demoSwapFree" value="1"
                                                        {{ old('demoSwapFree', isset($accountType->demo_islamic) && $accountType->demo_islamic == 1 ? 'checked' : '') }}>
                                                    <label class="form-check-label"
                                                        for="demoSwapFree">@lang('Enable Separate Swap-Free (Islamic) Account Type')</label>
                                                </div>
                                            </div>
                                            <div class="form-group" id="demoIslamicPlatformGroupContainer">
                                                <label for="demoIslamicPlatformGroup">@lang('Platform Group')</label>
                                                <input type="text" id="demoIslamicPlatformGroup" class="form-control"
                                                    name="demoIslamicInput"
                                                    value="{{ isset($accountType) ? $accountType->demo_islamic_input : old('demo_islamic_input') }}">
                                            </div>
                                            <div class="form-group">
                                                <label>@lang('Trading Server (Demo)')</label>
                                                <input type="text" class="form-control" value="MT5 Server" readonly
                                                    disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="form-group text-right">
                            <button type="submit" class="btn btn--primary">
                                <i class="fa fa-save"></i>
                                @if (isset($accountType))
                                    @lang('Update Account Type')
                                @else
                                    @lang('Create Account Type')
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
            <a href="{{ route('admin.accounttype.index') }}">
                <button class="btn btn--primary input-group-text">
                    <i class="fa fa-arrow-left"></i> @lang('Back to List')
                </button>
            </a>
        </div>
    </div>
@endpush

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2-multiple').select2({
                placeholder: "@lang('Select Countries/Tags')",
                allowClear: true
            });
        });
    </script>
@endpush

@push('style')
    <style>
        .select2-container .select2-selection--multiple {
            height: auto;
            border: 1px solid #ced4da;
            border-radius: .25rem;
            padding: .375rem .75rem;
            min-height: calc(1.5em + .75rem + 2px);
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: var(--bs-body-bg);
            border: 1px solid red;
            color: white;
            padding: .25rem .5rem;
            border-radius: 5px;
            margin: 2px 2px 2px 0;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            color: white;
            margin-right: .5rem;
        }

        #demoIslamicPlatformGroupContainer,
        #liveIslamicPlatformGroupContainer {
            display: none;
        }
    </style>
@endpush

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Demo Account Elements
            const demoSwapFreeCheckbox = document.getElementById('demoSwapFree');
            const demoIslamicPlatformGroupContainer = document.getElementById('demoIslamicPlatformGroupContainer');

            // Live Account Elements
            const liveSwapFreeCheckbox = document.getElementById('liveSwapFree');
            const liveIslamicPlatformGroupContainer = document.getElementById('liveIslamicPlatformGroupContainer');

            // Function to toggle visibility based on checkbox status
            function toggleIslamicPlatformGroup(checkbox, container) {
                if (checkbox.checked) {
                    container.style.display = 'block';
                } else {
                    container.style.display = 'none';
                }
            }

            // Initial check on page load for both accounts
            toggleIslamicPlatformGroup(demoSwapFreeCheckbox, demoIslamicPlatformGroupContainer);
            toggleIslamicPlatformGroup(liveSwapFreeCheckbox, liveIslamicPlatformGroupContainer);

            // Add event listeners for both checkboxes
            demoSwapFreeCheckbox.addEventListener('change', function() {
                toggleIslamicPlatformGroup(demoSwapFreeCheckbox, demoIslamicPlatformGroupContainer);
            });

            liveSwapFreeCheckbox.addEventListener('change', function() {
                toggleIslamicPlatformGroup(liveSwapFreeCheckbox, liveIslamicPlatformGroupContainer);
            });
        });
    </script>
@endpush
