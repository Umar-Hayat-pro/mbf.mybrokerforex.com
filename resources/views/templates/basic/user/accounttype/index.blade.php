@extends($activeTemplate . 'layouts.master')

@section('content')
    <div class="row gy-4"> <!-- Added `gy-4` for vertical spacing between rows -->
        <div class="col-12">
            <div class="dashboard-header-menu justify-content-between align-items-center">
                <h4 class="mb-0">{{ __($pageTitle) }}</h4>
            </div>
        </div>

        @if ($accountTypes && count($accountTypes) > 0)
            @foreach ($accountTypes as $account)
                <div class="col-lg-4 col-md-6 d-flex align-items-stretch"> <!-- Responsive grid with `d-flex` -->
                    <div class="card rounded-10 shadow-sm text-center flex-fill"> <!-- `flex-fill` to stretch card height -->
                        <div class="card-body d-flex flex-column justify-content-between">
                            <!-- Card Header -->
                            <header class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="text-start m-0">{{ $account['title'] }}</h5>
                                <span class="badge badge--success" style="font-size:13px" aria-label="{{ $account['badge'] }}">
                                    {{ $account['badge'] }}
                                </span>
                            </header>

                            <!-- Available Countries -->
                            @php
                                $countries = is_array($account['country']) ? $account['country'] : json_decode($account['country'], true);
                                // Ensure $countries is always an array
                                if (!is_array($countries)) {
                                    $countries = [];
                                }
                            @endphp
                            <p class="text-start text-success">Available in countries: {{ implode(', ', $countries) }}</p>
                            <p class="text-start" style="font-size: 12px;">{{ $account['description'] }}</p>
                            <!-- Account Details -->
                            <div class="account-details mt-4">
                                <div class="d-flex justify-content-between">
                                    <span>Initial Deposit:</span>
                                    <span class="badge badge--success">${{ $account['initial_deposit'] }}</span>
                                </div>
                                <div class="d-flex justify-content-between mt-2">
                                    <span>Spread:</span>
                                    <span>{{ $account['spread'] ?? 'N/A' }}</span>
                                </div>
                                <div class="d-flex justify-content-between mt-2">
                                    <span>Commission:</span>
                                    <span>{{ $account['commision'] }}</span>
                                </div>
                            </div>

                            <!-- Create Account Button -->
                            <a href="{{ route('user.account-view', ['id' => $account['id']]) }}"
                                class="btn btn--base outline btn--sm trade-btn mt-3" role="button">
                                Create Account
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="card col-12">
                <p class="text-center">No Accounts to show, try again later!</p>
            </div>
        @endif
    </div>
@endsection