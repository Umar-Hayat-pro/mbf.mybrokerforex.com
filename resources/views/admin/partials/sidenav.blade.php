<div class="sidebar bg--dark">
    <button class="res-sidebar-close-btn"><i class="las la-times"></i></button>
    <div class="sidebar__inner">
        <div class="sidebar__logo">
            <a href="{{ route('admin.dashboard') }}" class="sidebar__main-logo"><img src="{{ siteLogo() }}"></a>
        </div>
        <div class="sidebar__menu-wrapper" id="sidebar__menuWrapper">
            <ul class="sidebar__menu">
                <li class="sidebar-menu-item {{ menuActive('admin.dashboard') }}">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link ">
                        <i class="menu-icon las la-home"></i>
                        <span class="menu-title">@lang('Dashboard')</span>
                    </a>
                </li>
                <!--<li class="sidebar-menu-item sidebar-dropdown">-->
                <!--    <a href="javascript:void(0)" class="{{ menuActive(['admin.order*', 'admin.trade.history'], 3) }}">-->
                <!--        <i class="menu-icon las la-coins"></i>-->
                <!--        <span class="menu-title">@lang('Manage Order')</span>-->
                <!--    </a>-->
                <!--    <div class="sidebar-submenu {{ menuActive(['admin.order*', 'admin.trade.history'], 2) }} ">-->
                <!--        <ul>-->
                <!--            <li class="sidebar-menu-item {{ menuActive(['admin.order.open']) }}">-->
                <!--                <a href="{{ route('admin.order.open') }}" class="nav-link">-->
                <!--                    <i class="menu-icon las la-dot-circle"></i>-->
                <!--                    <span class="menu-title">@lang('Open Order')</span>-->
                <!--                </a>-->
                <!--            </li>-->
                <!--            <li class="sidebar-menu-item {{ menuActive(['admin.order.history']) }}">-->
                <!--                <a href="{{ route('admin.order.history') }}" class="nav-link">-->
                <!--                    <i class="menu-icon las la-dot-circle"></i>-->
                <!--                    <span class="menu-title">@lang('Order History')</span>-->
                <!--                </a>-->
                <!--            </li>-->
                <!--            <li class="sidebar-menu-item {{ menuActive(['admin.trade.history']) }}">-->
                <!--                <a href="{{ route('admin.trade.history') }}" class="nav-link">-->
                <!--                    <i class="menu-icon las la-dot-circle"></i>-->
                <!--                    <span class="menu-title">@lang('Trade History')</span>-->
                <!--                </a>-->
                <!--            </li>-->
                <!--        </ul>-->
                <!--    </div>-->
                <!--</li>-->
                <!--<li class="sidebar-menu-item sidebar-dropdown">-->
                <!--    <a href="javascript:void(0)" class="{{ menuActive('admin.p2p*', 3) }}">-->
                <!--        <i class="menu-icon las la-users"></i>-->
                <!--        <span class="menu-title">@lang('Manage P2P')</span>-->
                <!--        @if ($reportedTrade)
-->
                <!--        <span class="menu-badge pill bg--danger ms-auto">-->
                <!--            <i class="fa fa-exclamation"></i>-->
                <!--        </span>-->
                <!--
@endif-->
                <!--    </a>-->
                <!--    <div class="sidebar-submenu {{ menuActive('admin.p2p*', 2) }} ">-->
                <!--        <ul>-->
                <!--            <li class="sidebar-menu-item {{ menuActive('admin.p2p.trade.index', null, 'running') }} ">-->
                <!--                <a href="{{ route('admin.p2p.trade.index', 'running') }}" class="nav-link">-->
                <!--                    <i class="menu-icon las la-dot-circle"></i>-->
                <!--                    <span class="menu-title">@lang('Running Trade')</span>-->
                <!--                </a>-->
                <!--            </li>-->
                <!--            <li class="sidebar-menu-item {{ menuActive('admin.p2p.trade.index', null, 'reported') }} ">-->
                <!--                <a href="{{ route('admin.p2p.trade.index', 'reported') }}" class="nav-link">-->
                <!--                    <i class="menu-icon las la-dot-circle"></i>-->
                <!--                    <span class="menu-title">@lang('Reported Trade')</span>-->
                <!--                    @if ($reportedTrade)
-->
                <!--                        <span class="menu-badge pill bg--danger ms-auto">{{ $reportedTrade }}</span>-->
                <!--
@endif-->
                <!--                </a>-->
                <!--            </li>-->
                <!--            <li class="sidebar-menu-item {{ menuActive('admin.p2p.trade.index', null, 'completed') }} ">-->
                <!--                <a href="{{ route('admin.p2p.trade.index', 'completed') }}" class="nav-link">-->
                <!--                    <i class="menu-icon las la-dot-circle"></i>-->
                <!--                    <span class="menu-title">@lang('Completed Trade')</span>-->
                <!--                </a>-->
                <!--            </li>-->
                <!--            <li class="sidebar-menu-item {{ menuActive('admin.p2p.ad*') }} ">-->
                <!--                <a href="{{ route('admin.p2p.ad.index') }}" class="nav-link">-->
                <!--                    <i class="menu-icon las la-dot-circle"></i>-->
                <!--                    <span class="menu-title">@lang('Manage Ad')</span>-->
                <!--                </a>-->
                <!--            </li>-->
                <!--            <li class="sidebar-menu-item {{ menuActive('admin.p2p.payment.window*') }} ">-->
                <!--                <a href="{{ route('admin.p2p.payment.window.index') }}" class="nav-link">-->
                <!--                    <i class="menu-icon las la-dot-circle"></i>-->
                <!--                    <span class="menu-title">@lang('Payment Window')</span>-->
                <!--                </a>-->
                <!--            </li>-->
                <!--            <li class="sidebar-menu-item {{ menuActive('admin.p2p.payment.method*') }} ">-->
                <!--                <a href="{{ route('admin.p2p.payment.method.index') }}" class="nav-link">-->
                <!--                    <i class="menu-icon las la-dot-circle"></i>-->
                <!--                    <span class="menu-title">@lang('Payment Method')</span>-->
                <!--                </a>-->
                <!--            </li>-->
                <!--        </ul>-->
                <!--    </div>-->
                <!--</li>-->
                <li class="sidebar-menu-item sidebar-dropdown">
                    <a href="javascript:void(0)" class="{{ menuActive('admin.currency*', 3) }}">
                        <i class="menu-icon las la-coins"></i>
                        <span class="menu-title">@lang('Manage Currency')</span>
                    </a>
                    <div class="sidebar-submenu {{ menuActive('admin.currency*', 2) }} ">
                        <ul>
                            <li class="sidebar-menu-item {{ menuActive(['admin.currency.crypto']) }}">
                                <a href="{{ route('admin.currency.crypto') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Crypto Currency')</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item {{ menuActive(['admin.currency.fiat']) }}">
                                <a href="{{ route('admin.currency.fiat') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Fiat Currency')</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!--<li class="sidebar-menu-item {{ menuActive('admin.market.list') }}">-->
                <!--    <a href="{{ route('admin.market.list') }}" class="nav-link ">-->
                <!--        <i class="menu-icon las la-list"></i>-->
                <!--        <span class="menu-title">@lang('Manage Market')</span>-->
                <!--    </a>-->
                <!--</li>-->
                <!--<li class="sidebar-menu-item {{ menuActive('admin.coin.pair.*') }}">-->
                <!--    <a href="{{ route('admin.coin.pair.list') }}" class="nav-link ">-->
                <!--        <i class="menu-icon las la-list"></i>-->
                <!--        <span class="menu-title">@lang('Manage Coin Pair')</span>-->
                <!--    </a>-->
                <!--</li>-->


                <!--manage user starts here-->
                <li class="sidebar-menu-item sidebar-dropdown">
                    <a href="javascript:void(0)" class="{{ menuActive('admin.users*', 3) }}">
                        <i class="menu-icon las la-users"></i>
                        <span class="menu-title">@lang('Manage Users')</span>

                        @if (
                            $bannedUsersCount > 0 ||
                            $emailUnverifiedUsersCount > 0 ||
                            $mobileUnverifiedUsersCount > 0 ||
                            $kycUnverifiedUsersCount > 0 ||
                            $kycPendingUsersCount > 0 ||
                            $requestPendingUsersCount > 0
                        )
                                                    <span class="menu-badge pill bg--danger ms-auto">
                                                        <i class="fa fa-exclamation"></i>
                                                    </span>
                        @endif
                    </a>
                    <div class="sidebar-submenu {{ menuActive('admin.users*', 2) }} ">
                        <ul>
                            <li class="sidebar-menu-item {{ menuActive('admin.users.active') }} ">
                                <a href="{{ route('admin.users.active') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Active Users')</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item {{ menuActive('admin.users.banned') }} ">
                                <a href="{{ route('admin.users.banned') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Banned Users')</span>
                                    @if ($bannedUsersCount)
                                        <span class="menu-badge pill bg--danger ms-auto">{{ $bannedUsersCount }}</span>
                                    @endif
                                </a>
                            </li>

                            <li class="sidebar-menu-item  {{ menuActive('admin.users.email.unverified') }}">
                                <a href="{{ route('admin.users.email.unverified') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Email Unverified')</span>

                                    @if ($emailUnverifiedUsersCount)
                                        <span
                                            class="menu-badge pill bg--danger ms-auto">{{ $emailUnverifiedUsersCount }}</span>
                                    @endif
                                </a>
                            </li>

                            <li class="sidebar-menu-item {{ menuActive('admin.users.mobile.unverified') }}">
                                <a href="{{ route('admin.users.mobile.unverified') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Mobile Unverified')</span>
                                    @if ($mobileUnverifiedUsersCount)
                                        <span
                                            class="menu-badge pill bg--danger ms-auto">{{ $mobileUnverifiedUsersCount }}</span>
                                    @endif
                                </a>
                            </li>

                            <li class="sidebar-menu-item {{ menuActive('admin.users.kyc.unverified') }}">
                                <a href="{{ route('admin.users.kyc.unverified') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('KYC Unverified')</span>
                                    @if ($kycUnverifiedUsersCount)
                                        <span
                                            class="menu-badge pill bg--danger ms-auto">{{ $kycUnverifiedUsersCount }}</span>
                                    @endif
                                </a>
                            </li>

                            <li class="sidebar-menu-item {{ menuActive('admin.users.kyc.pending') }}">
                                <a href="{{ route('admin.users.kyc.pending') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('KYC Pending')</span>
                                    @if ($kycPendingUsersCount)
                                        <span class="menu-badge pill bg--danger ms-auto">{{ $kycPendingUsersCount }}</span>
                                    @endif
                                </a>
                            </li>
                            <li class="sidebar-menu-item {{ menuActive('admin.users.request.pending') }} ">
                                <a href="{{ route('admin.users.request.pending') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Profile Requests')</span>
                                    @if ($requestPendingUsersCount)
                                        <span
                                            class="menu-badge pill bg--danger ms-auto">{{ $requestPendingUsersCount }}</span>
                                    @endif
                                </a>
                            </li>
                            <li class="sidebar-menu-item {{ menuActive('admin.users.all') }} ">
                                <a href="{{ route('admin.users.all') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('All Users')</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item {{ menuActive('admin.users.notification.all') }}">
                                <a href="{{ route('admin.users.notification.all') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Email to All')</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="sidebar-menu-item {{ menuActive('admin.referrals.index') }}">
                    <a class="nav-link " href="{{ route('admin.referrals.index') }}">
                        <i class="menu-icon las la-tree"></i>
                        <span class="menu-title">@lang('Manage Referral')</span>
                    </a>
                </li>

                <li class="sidebar__menu-header">@lang('FOREX')</li>
                <!--Account type-->
                <li class="sidebar-menu-item sidebar-dropdown">
                    <a href="javascript:void(0)" class="{{ menuActive('admin.account_type*', 3) }}">
                        <i class="menu-icon las la-id-card"></i>
                        <span class="menu-title">@lang('Account Type')</span>
                    </a>
                    <div class="sidebar-submenu {{ menuActive('admin.account_type*', 2) }} ">
                        <ul>

                            <li class="sidebar-menu-item {{ menuActive('admin.accounttype.index') }}">
                                <a href="{{ route('admin.accounttype.index') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Account Types')</span>
                                </a>
                            </li>

                            <li class="sidebar-menu-item {{ menuActive('admin.ibaccounttype.*') }}">
                                <a href="{{ route('admin.ibaccounttype.index') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('IB Account Type')</span>
                                </a>
                            </li>

                            <li class="sidebar-menu-item {{ menuActive('admin.blacklist.index') }} ">
                                <a href="{{ route('admin.blacklist.index') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Blacklist Countries')</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!--Account type ends-->
                {{-- Forex Account --}}
                <li class="sidebar-menu-item sidebar-dropdown">
                    <a href="javascript:void(0)" class="{{ menuActive('admin.demo_accounts.index*', 3) }}">
                        <i class="menu-icon las la-id-card"></i>
                        <span class="menu-title">@lang('Forex Account')</span>
                    </a>
                    <div class="sidebar-submenu {{ menuActive('admin.live_account.index*', 2) }} ">
                        <ul>

                            <li class="sidebar-menu-item {{ menuActive('admin.live_accounts.index') }}">
                                <a href="{{ route('admin.live_accounts.index') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Live Account')</span>
                                </a>
                            </li>

                            <li class="sidebar-menu-item {{ menuActive('admin.demo_accounts.index*') }}">
                                <a href="{{ route('admin.demo_accounts.index') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Demo Account ')</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                {{-- Forex Account ends --}}
                <li class="sidebar__menu-header">@lang('ESSENTIALS')</li>

                <li class="sidebar-menu-item sidebar-dropdown">
                    <a href="javascript:void(0)" class="{{ menuActive('admin.gateway*', 3) }}">
                        <i class="menu-icon las la-credit-card"></i>
                        <span class="menu-title">@lang('Payment Gateways')</span>
                    </a>
                    <div class="sidebar-submenu {{ menuActive('admin.gateway*', 2) }} ">
                        <ul>
                            <li class="sidebar-menu-item {{ menuActive('admin.gateway.automatic.*') }} ">
                                <a href="{{ route('admin.gateway.automatic.index') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Automatic Gateways')</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item {{ menuActive('admin.gateway.manual.*') }} ">
                                <a href="{{ route('admin.gateway.manual.index') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Manual Gateways')</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="sidebar-menu-item sidebar-dropdown">
                    <a href="javascript:void(0)" class="{{ menuActive('admin.deposit*', 3) }}">
                        <i class="menu-icon las la-file-invoice-dollar"></i>
                        <span class="menu-title">@lang('Deposits')</span>
                        @if (0 < $pendingDepositsCount)
                            <span class="menu-badge pill bg--danger ms-auto">
                                <i class="fa fa-exclamation"></i>
                            </span>
                        @endif
                    </a>
                    <div class="sidebar-submenu {{ menuActive('admin.deposit*', 2) }} ">
                        <ul>
                            <li class="sidebar-menu-item {{ menuActive('admin.deposit.pending') }} ">
                                <a href="{{ route('admin.deposit.pending') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Pending Deposits')</span>
                                    @if ($pendingDepositsCount)
                                        <span class="menu-badge pill bg--danger ms-auto">{{ $pendingDepositsCount }}</span>
                                    @endif
                                </a>
                            </li>
                            <li class="sidebar-menu-item {{ menuActive('admin.deposit.approved') }} ">
                                <a href="{{ route('admin.deposit.approved') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Approved Deposits')</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item {{ menuActive('admin.deposit.successful') }} ">
                                <a href="{{ route('admin.deposit.successful') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Successful Deposits')</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item {{ menuActive('admin.deposit.rejected') }} ">
                                <a href="{{ route('admin.deposit.rejected') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Rejected Deposits')</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item {{ menuActive('admin.deposit.initiated') }} ">
                                <a href="{{ route('admin.deposit.initiated') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Initiated Deposits')</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item {{ menuActive('admin.deposit.list') }} ">
                                <a href="{{ route('admin.deposit.list') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('All Deposits')</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="sidebar-menu-item sidebar-dropdown">
                    <a href="javascript:void(0)" class="{{ menuActive('admin.withdraw*', 3) }}">
                        <i class="menu-icon la la-bank"></i>
                        <span class="menu-title">@lang('Withdrawals') </span>
                        @if (0 < $pendingWithdrawCount)
                            <span class="menu-badge pill bg--danger ms-auto">
                                <i class="fa fa-exclamation"></i>
                            </span>
                        @endif
                    </a>
                    <div class="sidebar-submenu {{ menuActive('admin.withdraw*', 2) }} ">
                        <ul>
                            <li class="sidebar-menu-item {{ menuActive('admin.withdraw.method.*') }}">
                                <a href="{{ route('admin.withdraw.method.index') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Withdrawal Methods')</span>
                                </a>
                            </li>

                            <li class="sidebar-menu-item {{ menuActive('admin.withdraw.pending') }} ">
                                <a href="{{ route('admin.withdraw.pending') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Pending Withdrawals')</span>

                                    @if ($pendingWithdrawCount)
                                        <span class="menu-badge pill bg--danger ms-auto">{{ $pendingWithdrawCount }}</span>
                                    @endif
                                </a>
                            </li>

                            <li class="sidebar-menu-item {{ menuActive('admin.withdraw.approved') }} ">
                                <a href="{{ route('admin.withdraw.approved') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Approved Withdrawals')</span>
                                </a>
                            </li>

                            <li class="sidebar-menu-item {{ menuActive('admin.withdraw.rejected') }} ">
                                <a href="{{ route('admin.withdraw.rejected') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Rejected Withdrawals')</span>
                                </a>
                            </li>

                            <li class="sidebar-menu-item {{ menuActive('admin.withdraw.log') }} ">
                                <a href="{{ route('admin.withdraw.log') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('All Withdrawals')</span>
                                </a>
                            </li>


                        </ul>
                    </div>
                </li>
                <li class="sidebar-menu-item sidebar-dropdown">
                    <a href="javascript:void(0)" class="{{ menuActive('admin.ticket*', 3) }}">
                        <i class="menu-icon la la-ticket"></i>
                        <span class="menu-title">@lang('Support Ticket') </span>
                        @if (0 < $pendingTicketCount)
                            <span class="menu-badge pill bg--danger ms-auto">
                                <i class="fa fa-exclamation"></i>
                            </span>
                        @endif
                    </a>
                    <div class="sidebar-submenu {{ menuActive('admin.ticket*', 2) }} ">
                        <ul>
                            <li class="sidebar-menu-item {{ menuActive('admin.ticket.pending') }} ">
                                <a href="{{ route('admin.ticket.pending') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Pending Ticket')</span>
                                    @if ($pendingTicketCount)
                                        <span class="menu-badge pill bg--danger ms-auto">{{ $pendingTicketCount }}</span>
                                    @endif
                                </a>
                            </li>
                            <li class="sidebar-menu-item {{ menuActive('admin.ticket.closed') }} ">
                                <a href="{{ route('admin.ticket.closed') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Closed Ticket')</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item {{ menuActive('admin.ticket.answered') }} ">
                                <a href="{{ route('admin.ticket.answered') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Answered Ticket')</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item {{ menuActive('admin.ticket.index') }} ">
                                <a href="{{ route('admin.ticket.index') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('All Ticket')</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="sidebar-menu-item sidebar-dropdown">
                    <a href="javascript:void(0)" class="{{ menuActive('admin.report*', 3) }}">
                        <i class="menu-icon la la-list"></i>
                        <span class="menu-title">@lang('Report') </span>
                    </a>
                    <div class="sidebar-submenu {{ menuActive('admin.report*', 2) }} ">
                        <ul>
                            <li
                                class="sidebar-menu-item {{ menuActive(['admin.report.transaction', 'admin.report.transaction.search']) }}">
                                <a href="{{ route('admin.report.transaction') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Transaction Log')</span>
                                </a>
                            </li>

                            <li
                                class="sidebar-menu-item {{ menuActive(['admin.report.login.history', 'admin.report.login.ipHistory']) }}">
                                <a href="{{ route('admin.report.login.history') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Login History')</span>
                                </a>
                            </li>

                            <li class="sidebar-menu-item {{ menuActive('admin.report.notification.history') }}">
                                <a href="{{ route('admin.report.notification.history') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Notification History')</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>


                <li class="sidebar-menu-item  {{ menuActive('admin.subscriber.*') }}">
                    <a href="{{ route('admin.subscriber.index') }}" class="nav-link"
                        data-default-url="{{ route('admin.subscriber.index') }}">
                        <i class="menu-icon las la-thumbs-up"></i>
                        <span class="menu-title">@lang('Subscribers') </span>
                    </a>
                </li>

                {{-- Ib Setting Start here --}}

                <li class="sidebar__menu-header">@lang('IB Settings')</li>

                <li class="sidebar-menu-item sidebar-dropdown">
                    <a href="javascript:void(0)" class="{{ menuActive('admin.become_ib*', 3) }}">
                        <i class="menu-icon las la-id-card"></i>
                        <span class="menu-title">@lang('Manage Ib')</span>
                    </a>
                    <div class="sidebar-submenu {{ menuActive('admin.account_type*', 2) }} ">
                        <ul>

                            <li class="sidebar-menu-item {{ menuActive('admin.pending_ib') }}">
                                <a href="{{ route('admin.pending_ib') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Pending IB')</span>
                                </a>
                            </li>

                            <li class="sidebar-menu-item {{ menuActive('admin.active_ib*') }}">
                                <a href="{{ route('admin.active_ib') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Approved IB')</span>
                                </a>
                            </li>

                            <li class="sidebar-menu-item {{ menuActive('admin.rejected_ib') }} ">
                                <a href="{{ route('admin.rejected_ib') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Rejected IB')</span>
                                </a>
                            </li>

                            <li class="sidebar-menu-item {{ menuActive('admin.all_ib') }} ">
                                <a href="{{ route('admin.all_ib') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('All IB Logs')</span>
                                </a>
                            </li>

                            <li class="sidebar-menu-item {{ menuActive('admin.form_ib') }} ">
                                <a href="{{ route('admin.form_ib') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('IB Form')</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>


                <li class="sidebar__menu-header">@lang('Settings')</li>

                <li class="sidebar-menu-item {{ menuActive('admin.setting.index') }}">
                    <a href="{{ route('admin.setting.index') }}" class="nav-link">
                        <i class="menu-icon las la-life-ring"></i>
                        <span class="menu-title">@lang('General Setting')</span>
                    </a>
                </li>

                <li class="sidebar-menu-item {{ menuActive('admin.cron*') }}">
                    <a href="{{ route('admin.cron.index') }}" class="nav-link">
                        <i class="menu-icon las la-clock"></i>
                        <span class="menu-title">@lang('Cron Job Setting')</span>
                    </a>
                </li>

                <li class="sidebar-menu-item {{ menuActive('admin.setting.system.configuration') }}">
                    <a href="{{ route('admin.setting.system.configuration') }}" class="nav-link">
                        <i class="menu-icon las la-cog"></i>
                        <span class="menu-title">@lang('System Configuration')</span>
                    </a>
                </li>
                <li class="sidebar-menu-item {{ menuActive('admin.setting.pusher.configuration') }}">
                    <a href="{{ route('admin.setting.pusher.configuration') }}" class="nav-link">
                        <i class="menu-icon las la-cogs"></i>
                        <span class="menu-title">@lang('Pusher Configuration')</span>
                    </a>
                </li>
                <li class="sidebar-menu-item {{ menuActive('admin.setting.chart') }}">
                    <a href="{{ route('admin.setting.chart') }}" class="nav-link">
                        <i class="menu-icon las la-tools"></i>
                        <span class="menu-title">@lang('Chart Setting')</span>
                    </a>
                </li>
                <li class="sidebar-menu-item {{ menuActive('admin.setting.charge') }}">
                    <a href="{{ route('admin.setting.charge') }}" class="nav-link">
                        <i class="menu-icon las la-money-check"></i>
                        <span class="menu-title">@lang('Charge Setting')</span>
                    </a>
                </li>
                <li class="sidebar-menu-item {{ menuActive('admin.wallet.setting') }}">
                    <a href="{{ route('admin.wallet.setting') }}" class="nav-link">
                        <i class="menu-icon las la-wallet"></i>
                        <span class="menu-title">@lang('Wallet Setting')</span>
                    </a>
                </li>
                <li class="sidebar-menu-item {{ menuActive('admin.setting.socialite.credentials') }}">
                    <a href="{{ route('admin.setting.socialite.credentials') }}" class="nav-link">
                        <i class="menu-icon las la-users-cog"></i>
                        <span class="menu-title">@lang('Social Credentials')</span>
                    </a>
                </li>
                <li class="sidebar-menu-item {{ menuActive('admin.currency.data.provider.index') }}">
                    <a href="{{ route('admin.currency.data.provider.index') }}" class="nav-link">
                        <i class="menu-icon las la-cog"></i>
                        <span class="menu-title">@lang('Currency Data Provider')</span>
                    </a>
                </li>
                <li class="sidebar-menu-item {{ menuActive('admin.setting.logo.icon') }}">
                    <a href="{{ route('admin.setting.logo.icon') }}" class="nav-link">
                        <i class="menu-icon las la-images"></i>
                        <span class="menu-title">@lang('Logo & Favicon')</span>
                    </a>
                </li>

                <li class="sidebar-menu-item {{ menuActive('admin.extensions.index') }}">
                    <a href="{{ route('admin.extensions.index') }}" class="nav-link">
                        <i class="menu-icon las la-cogs"></i>
                        <span class="menu-title">@lang('Extensions')</span>
                    </a>
                </li>

                <li class="sidebar-menu-item  {{ menuActive(['admin.language.manage', 'admin.language.key']) }}">
                    <a href="{{ route('admin.language.manage') }}" class="nav-link"
                        data-default-url="{{ route('admin.language.manage') }}">
                        <i class="menu-icon las la-language"></i>
                        <span class="menu-title">@lang('Language') </span>
                    </a>
                </li>

                <li class="sidebar-menu-item {{ menuActive('admin.seo') }}">
                    <a href="{{ route('admin.seo') }}" class="nav-link">
                        <i class="menu-icon las la-globe"></i>
                        <span class="menu-title">@lang('SEO Manager')</span>
                    </a>
                </li>

                <li class="sidebar-menu-item {{ menuActive('admin.kyc.setting') }}">
                    <a href="{{ route('admin.kyc.setting') }}" class="nav-link">
                        <i class="menu-icon las la-user-check"></i>
                        <span class="menu-title">@lang('KYC Setting')</span>
                    </a>
                </li>

                <li class="sidebar-menu-item {{ menuActive('admn.user.profile.settings') }}">
                    <a class="nav-link" href="{{ route('admin.user.profile.settings') }}">
                        <i class="menu-icon las la-user-check"></i>
                        <span class="menu-title">
                            @lang("User Profile Settings")
                        </span>
                    </a>

                </li>


                <li class="sidebar-menu-item sidebar-dropdown">
                    <a href="javascript:void(0)" class="{{ menuActive('admin.setting.notification*', 3) }}">
                        <i class="menu-icon las la-bell"></i>
                        <span class="menu-title">@lang('Notification Setting')</span>
                    </a>
                    <div class="sidebar-submenu {{ menuActive('admin.setting.notification*', 2) }} ">
                        <ul>
                            <li class="sidebar-menu-item {{ menuActive('admin.setting.notification.global') }} ">
                                <a href="{{ route('admin.setting.notification.global') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Global Template')</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item {{ menuActive('admin.setting.notification.email') }} ">
                                <a href="{{ route('admin.setting.notification.email') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Email Setting')</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item {{ menuActive('admin.setting.notification.sms') }} ">
                                <a href="{{ route('admin.setting.notification.sms') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('SMS Setting')</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item {{ menuActive('admin.setting.notification.templates') }} ">
                                <a href="{{ route('admin.setting.notification.templates') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Notification Templates')</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="sidebar__menu-header">@lang('Frontend Manager')</li>

                <!--<li class="sidebar-menu-item {{ menuActive('admin.frontend.templates') }}">-->
                <!--    <a href="{{ route('admin.frontend.templates') }}" class="nav-link ">-->
                <!--        <i class="menu-icon la la-html5"></i>-->
                <!--        <span class="menu-title">@lang('Manage Templates')</span>-->
                <!--    </a>-->
                <!--</li>-->

                <li class="sidebar-menu-item {{ menuActive('admin.frontend.manage.*') }}">
                    <a href="{{ route('admin.frontend.manage.pages') }}" class="nav-link ">
                        <i class="menu-icon la la-list"></i>
                        <span class="menu-title">@lang('Manage Pages')</span>
                    </a>
                </li>

                <li class="sidebar-menu-item sidebar-dropdown">
                    <a href="javascript:void(0)" class="{{ menuActive('admin.frontend.sections*', 3) }}">
                        <i class="menu-icon la la-puzzle-piece"></i>
                        <span class="menu-title">@lang('Manage Section')</span>
                    </a>
                    <div class="sidebar-submenu {{ menuActive('admin.frontend.sections*', 2) }} ">
                        <ul>
                            @php
                                $lastSegment = collect(request()->segments())->last();
                            @endphp
                            @foreach (getPageSections(true) as $k => $secs)
                                @if ($secs['builder'])
                                    <li class="sidebar-menu-item  @if ($lastSegment == $k) active @endif ">
                                        <a href="{{ route('admin.frontend.sections', $k) }}" class="nav-link">
                                            <i class="menu-icon las la-dot-circle"></i>
                                            <span class="menu-title">{{ __($secs['name']) }}</span>
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </li>

                <li class="sidebar__menu-header">@lang('Extra')</li>

                <li class="sidebar-menu-item {{ menuActive('admin.maintenance.mode') }}">
                    <a href="{{ route('admin.maintenance.mode') }}" class="nav-link">
                        <i class="menu-icon las la-robot"></i>
                        <span class="menu-title">@lang('Maintenance Mode')</span>
                    </a>
                </li>

                <li class="sidebar-menu-item {{ menuActive('admin.setting.cookie') }}">
                    <a href="{{ route('admin.setting.cookie') }}" class="nav-link">
                        <i class="menu-icon las la-cookie-bite"></i>
                        <span class="menu-title">@lang('GDPR Cookie')</span>
                    </a>
                </li>

                <li class="sidebar-menu-item sidebar-dropdown">
                    <a href="javascript:void(0)" class="{{ menuActive('admin.system*', 3) }}">
                        <i class="menu-icon la la-server"></i>
                        <span class="menu-title">@lang('System')</span>
                    </a>
                    <div class="sidebar-submenu {{ menuActive('admin.system*', 2) }} ">
                        <ul>
                            <li class="sidebar-menu-item {{ menuActive('admin.system.info') }} ">
                                <a href="{{ route('admin.system.info') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Application')</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item {{ menuActive('admin.system.server.info') }} ">
                                <a href="{{ route('admin.system.server.info') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Server')</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item {{ menuActive('admin.system.optimize') }} ">
                                <a href="{{ route('admin.system.optimize') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Cache')</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item {{ menuActive('admin.system.update') }} ">
                                <a href="{{ route('admin.system.update') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Update')</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                {{-- <li class="sidebar-menu-item {{ menuActive('admin.setting.custom.css') }}">
                    <a href="{{ route('admin.setting.custom.css') }}" class="nav-link">
                        <i class="menu-icon lab la-css3-alt"></i>
                        <span class="menu-title">@lang('Custom CSS')</span>
                    </a>
                </li> --}}
                <!--<li class="sidebar-menu-item  {{ menuActive('admin.request.report') }}">-->
                <!--    <a href="{{ route('admin.request.report') }}" class="nav-link"-->
                <!--       data-default-url="{{ route('admin.request.report') }}">-->
                <!--        <i class="menu-icon las la-bug"></i>-->
                <!--        <span class="menu-title">@lang('Report & Request') </span>-->
                <!--    </a>-->
                <!--</li>-->
            </ul>
            <div class="text-center mb-3 text-uppercase">
                <span class="text--primary">MBFX</span>
                <span class="text--success">@lang('V')1.0 </span>
            </div>
            <!--<div class="text-center mb-3 text-uppercase">-->
            <!--    <span class="text--primary">{{ __(systemDetails()['name']) }}</span>-->
            <!--    <span class="text--success">@lang('V'){{ systemDetails()['version'] }} </span>-->
            <!--</div>-->
        </div>
    </div>
</div>
<!-- sidebar end -->

@push('script')
    <script>
        if ($('li').hasClass('active')) {
            $('#sidebar__menuWrapper').animate({
                scrollTop: eval($(".active").offset().top - 320)
            }, 500);
        }
    </script>
@endpush