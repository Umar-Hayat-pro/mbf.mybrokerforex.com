{{-- Referral URL and Tree Section --}}
<div class="row gy-4 mb-3 justify-content-start">
    <div class="col-lg-12">
        <div class="transection h-100">
            <h3 class="transection__title skeleton">@lang('Referral URL and Tree')</h3>

            {{-- Check if user has a referrer --}}
            @if ($user->referrer)
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h4>@lang('User was referred by') <span
                                    class="text--base">{{ @$user->referrer->fullname }}</span></h4>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Check if user has referrals and if the max level is greater than 0 --}}
            @if ($user->allReferrals->count() > 1 && $maxLevel > 10)
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="text-start">@lang('Users Referred By ') <span
                                            class="twxt--base">{{ @$user->fullname}}</span></h5>
                                </div>
                                <div class="card-body">
                                    <div class="treeview-container">
                                        <ul class="treeview">
                                            <li class="items-expanded">{{ $user->fullname }} ({{ $user->username }})
                                                @include($activeTemplate . 'partials.under_tree', [
                    'user' => $user,
                    'layer' => 0,
                    'isFirst' => true,
                ])
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
            @else
                {{-- Show empty section if no referrals or referrer --}}
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body p-5">
                            <div class="empty-thumb text-center">
                                <img src="{{ asset('assets/images/extra_images/empty.png') }}"
                                    alt="@lang('No data found')" />
                                <p class="fs-14">@lang('No data found')</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
{{-- End of Referral URL and Tree Section --}}