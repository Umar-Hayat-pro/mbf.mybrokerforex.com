<div class="sidebar-menu">
    <div class="sidebar-menu__inner">
        <span class="sidebar-menu__close d-xl-none d-block"><i class="fas fa-times"></i></span>
        <div class="sidebar-logo">
            <a href="{{ route('user.home') }}" class="sidebar-logo__link">
                <img src="{{ siteLogo() }}">
            </a>
        </div>
        <ul class="sidebar-menu-list">
            <li class="sidebar-menu-list__item ">
                <a href="{{ route('user.home') }}" class="sidebar-menu-list__link {{ menuActive('user.home') }}">
                    <span class="icon"><span class="icon-dashboard"></span></span>
                    <span class="text">@lang('Dashboard')</span>
                </a>
            </li>
            <!--<li class="sidebar-menu-list__item ">-->
            <!--    <a href="{{ url('/ibform/') }}" class="sidebar-menu-list__link {{ url('/ibform/') }}">-->
            <!--        <span class="icon"><span class="icon-affiliation"></span></span>-->
            <!--        <span class="text">@lang('Become an IB')</span>-->
            <!--    </a>-->
            <!--</li>-->
            <li class="sidebar-menu-list__item ">
                <a href="{{ route('user.order.open') }}"
                    class="sidebar-menu-list__link {{ menuActive('user.order.*') }} ">
                    <span class="icon"><span class="icon-order"></span></span>
                    <span class="text">@lang('Manage Order')</span>
                </a>
            </li>

            @php
                $user = auth()->user();
            @endphp


            @if ($user->kv == 1)
                {{-- This will check if the user is kyc verified --}}
                <li class="sidebar-menu-list__item ">
                    <a href="{{ route('user.account-type-index') }}"
                        class="sidebar-menu-list__link {{ menuActive('user.account-type-index*') }} ">
                        <span class="icon"><span class="las la-user-plus"></span></span>
                        <span class="text">@lang('New Account')</span>
                    </a>
                </li>
            @else
                <li class="sidebar-menu-list__item ">
                    <a href="{{ route('admin.kycVerification') }}"
                        class="sidebar-menu-list__link {{ menuActive('user.account-type-index*') }} ">
                        <span class="icon"><span class="las la-user-plus"></span></span>
                        <span class="text">@lang('New Account')</span>
                    </a>
                </li>
            @endif

            <li class="sidebar-menu-list__item ">
                    <a href="{{ route('user.user-accounts') }}"
                        class="sidebar-menu-list__link {{ menuActive('user.user-accounts*') }} ">
                        <span class="icon"><span class="las la-users"></span></span>
                        <span class="text">@lang('My Accounts')</span>
                    </a>
                </li>

            <li class="sidebar-menu-list__item ">
                <a href="{{ route('user.trade.history') }}"
                    class="sidebar-menu-list__link {{ menuActive('user.trade.history') }} ">
                    <span class="icon"><span class="icon-trade"></span></span>
                    <span class="text">@lang('Trade History')</span>
                </a>
            </li>


            {{-- This is Become IB --}}

            @if ($user->kv == 1)
                {{-- User is KYC verified --}}
                @if ($user->partner == 1)
                    {{-- Users partner requeust is approved --}}
                    <li class="sidebar-menu-list__item">
                        <a href="{{ route('user.ib_dashboard') }}"
                            class="sidebar-menu-list__link {{ menuActive('user.user_become_ib') }}">
                            <span class="icon"><span class="lar la-handshake"></span></span>
                            <span class="text">@lang('Partnership')</span>
                        </a>
                    </li>
                @elseif ($user->partner == 3)
                    {{-- Users partner request was rejected --}}
                    <li class="sidebar-menu-list__item">
                        <a href="{{ route('user.rejected_user_ib') }}"
                            class="sidebar-menu-list__link {{ menuActive('user.user_become_ib') }}">
                            <span class="icon"><span class="lar la-handshake"></span></span>
                            <span class="text">@lang('Partnership')</span>
                        </a>
                    </li>
                @elseif ($user->partner == 2)
                    {{-- THIS WILL SHOW IF USER IS PENDING --}}
                    <li class="sidebar-menu-list__item">
                        <a href="{{ route('user.pending_user_ib') }}"
                            class="sidebar-menu-list__link {{ menuActive('user.user_become_ib') }}">
                            <span class="icon"><span class="lar la-handshake"></span></span>
                            <span class="text">@lang('Partnership')</span>
                        </a>
                    </li>
                @else
                    {{-- THIS IS UNPROCESSED --}}
                    <li class="sidebar-menu-list__item">
                        <a href="{{ route('user.user_become_ib') }}"
                            class="sidebar-menu-list__link {{ menuActive('user.user_become_ib') }}">
                            <span class="icon"><span class="lar la-handshake"></span></span>
                            <span class="text">@lang('Partnership')</span>
                        </a>
                    </li>
                @endif
            @else
                {{-- User is not KYC verified --}}
                <li class="sidebar-menu-list__item">
                <li class="sidebar-menu-list__item">
                    <a href="{{ route('admin.kycVerification') }}"
                        class="sidebar-menu-list__link {{ menuActive('user.user_become_ib') }}">
                        <span class="icon"><span class="lar la-handshake"></span></span>
                        <span class="text">@lang('Partnership')</span>
                    </a>
                </li>
                </li>
            @endif

            {{-- <li class="sidebar-menu-list__item ">
                      <a href="{{route('user.p2p.dashboard')}}" class="sidebar-menu-list__link {{ menuActive('user.p2p.dashboard') }} ">
                          <span class="icon"><span class="icon-trade"></span></span>
                          <span class="text">@lang('P2P Center')</span>
                      </a>
                  </li> --}}

            <li class="sidebar-menu-list__item ">
                <a href="{{ route('user.walletOverview') }}"
                    class="sidebar-menu-list__link {{ menuActive('user.wallet.*') }}">
                    <span class="icon"><span class="icon-wallet"></span></span>
                    <span class="text">@lang('Wallet Overview')</span>
                </a>
            </li>

            <li class="sidebar-menu-list__item ">
                <a href="{{ route('user.deposit') }}"
                    class="sidebar-menu-list__link {{ menuActive('user.deposit.*') }}">
                    <span class="icon"><span class="icon-deposit"></span></span>
                    <span class="text">@lang('Deposit')</span>
                </a>
            </li>

            <li class="sidebar-menu-list__item ">
                <a href="{{ route('user.withdraw') }}"
                    class="sidebar-menu-list__link {{ menuActive('user.withdraw') }}">
                    <span class="icon"><span class="icon-withdraw"></span></span>
                    <span class="text">@lang('Withdraw ')</span>
                </a>
            </li>


            <li class="sidebar-menu-list__item ">
                <a href="{{ route('user.referrals') }}"
                    class="sidebar-menu-list__link {{ menuActive('user.referrals') }}">
                    <span class="icon"><span class="icon-affiliation"></span></span>
                    <span class="text">@lang('My Affiliation')</span>
                </a>
            </li>
            <li class="sidebar-menu-list__item ">
                <a href="{{ route('user.transactions') }}"
                    class="sidebar-menu-list__link {{ menuActive('user.transactions') }}">
                    <span class="icon"><span class="icon-transaction"></span></span>
                    <span class="text">@lang('Transaction Histoy')</span>
                </a>
            </li>
            <li class="sidebar-menu-list__item ">
                <a href="{{ route('ticket.index') }}" class="sidebar-menu-list__link {{ menuActive('ticket.*') }}">
                    <span class="icon"><span class="icon-support"></span></span>
                    <span class="text">@lang('Get Support')</span>
                </a>
            </li>
            <li class="sidebar-menu-list__item ">
                <a href="{{ route('user.twofactor') }}"
                    class="sidebar-menu-list__link {{ menuActive('user.twofactor') }}">
                    <span class="icon"><span class="icon-security"></span></span>
                    <span class="text">@lang('Security')</span>
                </a>
            </li>
            <li class="sidebar-menu-list__item ">
                <a href="{{ route('user.logout') }}" class="sidebar-menu-list__link">
                    <span class="icon"><span class="icon-logout"></span></span>
                    <span class="text">@lang('Logout')</span>
                </a>
            </li>
        </ul>
    </div>
</div>
