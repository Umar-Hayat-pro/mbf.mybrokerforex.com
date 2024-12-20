<!-- navbar-wrapper start -->
<nav class="navbar-wrapper bg--dark">
    <div class="navbar__left">
        <button type="button" class="res-sidebar-open-btn me-3"><i class="las la-bars"></i></button>
        <form class="navbar-search">
            <input type="search" name="#0" class="navbar-search-field" id="searchInput" autocomplete="off"
                placeholder="@lang('Search here...')">
            <i class="las la-search"></i>
            <ul class="search-list"></ul>
        </form>
    </div>
    <div class="navbar__right">
        <ul class="navbar__action-list">
            <div class="card-footer2">
                <a href="https://mbf.mybrokerforex.com/admin/system/optimize-clear" class="btn btn--primary w-80 h-25" 
                style="margin-right:20px; font-size:10px;">Clear Cache</a>
            </div>
            <button type="button" class="primary--layer" data-bs-toggle="tooltip" 
            data-bs-placement="bottom" aria-label="Visit Website" data-bs-original-title="Visit Website">
                  <a href="https://mybrokerforex.com" target="_blank"><i class="las la-globe"></i></a>
                </button>
            <li class="dropdown">
                <!--<button type="button" class="primary--layer" data-bs-toggle="dropdown" data-display="static"-->
                <!--    aria-haspopup="true" aria-expanded="false">-->
                <!--    <i class="las la-bell text--primary @if($adminNotificationCount > 0) icon-left-right @endif"></i>-->
                <!--</button>-->
                
                <button type="button" class="primary--layer notification-bell" data-bs-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="false">
                    <span data-bs-toggle="tooltip" data-bs-placement="bottom" aria-label="Unread Notifications" data-bs-original-title="Unread Notifications">
                        <i class="las la-bell  icon-left-right "></i>
                    </span>
                    <span class="notification-count">9+</span>
                </button>
                
                <button type="button" class="primary--layer" data-bs-toggle="tooltip" data-bs-placement="bottom" aria-label="System Setting" data-bs-original-title="System Configuration">
                    <a href="{{ route('admin.setting.system.configuration')}}"><i class="las la-wrench"></i></a>
                </button>
                <div class="dropdown-menu dropdown-menu--md p-0 border-0 box--shadow1 dropdown-menu-right">
                    <div class="dropdown-menu__header">
                        <span class="caption">@lang('Notification')</span>
                        @if($adminNotificationCount > 0)
                            <p>@lang('You have') {{ $adminNotificationCount }} @lang('unread notification')</p>
                        @else
                            <p>@lang('No unread notification found')</p>
                        @endif
                    </div>
                    <div class="dropdown-menu__body">
                        @foreach($adminNotifications as $notification)
                            <a href="{{ route('admin.notification.read',$notification->id) }}"
                                class="dropdown-menu__item">
                                <div class="navbar-notifi">
                                    <div class="navbar-notifi__right">
                                        <h6 class="notifi__title">{{ __($notification->title) }}</h6>
                                        <span class="time"><i class="far fa-clock"></i>
                                            {{ $notification->created_at->diffForHumans() }}</span>
                                    </div>
                                </div><!-- navbar-notifi end -->
                            </a>
                        @endforeach
                    </div>
                    <div class="dropdown-menu__footer">
                        <a href="{{ route('admin.notifications') }}"
                            class="view-all-message">@lang('View all notification')</a>
                    </div>
                </div>
            </li>


            <li class="dropdown">
                <button type="button" class="" data-bs-toggle="dropdown" data-display="static" aria-haspopup="true"
                    aria-expanded="false">
                    <span class="navbar-user">
                        <span class="navbar-user__thumb"><img
                            src="{{ getImage(getFilePath('adminProfile').'/'. auth()->guard('admin')->user()->image,getFileSize('adminProfile'))}}"
                                alt="image"></span>
                        <span class="navbar-user__info">
                            <span
                                class="navbar-user__name">{{ auth()->guard('admin')->user()->username }}</span>
                        </span>
                        <span class="icon"><i class="las la-chevron-circle-down"></i></span>
                    </span>
                </button>
                <div class="dropdown-menu dropdown-menu--sm p-0 border-0 box--shadow1 dropdown-menu-right">
                    <a href="{{ route('admin.profile') }}"
                        class="dropdown-menu__item d-flex align-items-center px-3 py-2">
                        <i class="dropdown-menu__icon las la-user-circle"></i>
                        <span class="dropdown-menu__caption">@lang('Profile')</span>
                    </a>

                    <a href="{{ route('admin.password') }}"
                        class="dropdown-menu__item d-flex align-items-center px-3 py-2">
                        <i class="dropdown-menu__icon las la-key"></i>
                        <span class="dropdown-menu__caption">@lang('Password')</span>
                    </a>

                    <a href="{{ route('admin.logout') }}"
                        class="dropdown-menu__item d-flex align-items-center px-3 py-2">
                        <i class="dropdown-menu__icon las la-sign-out-alt"></i>
                        <span class="dropdown-menu__caption">@lang('Logout')</span>
                    </a>
                </div>
            </li>
        </ul>
    </div>
</nav>
<!-- navbar-wrapper end -->
