<div class="flex">
    <ul class="nav nav-tabs mt-2">

      <li class="nav-item">
        <a href="{{ route('admin.users.detail', $user->id ) }}"
          class="nav-link {{ menuActive('admin.users.detail', 'active') }}">
          <span class="menu-title">@lang('Overview')</span>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ route('admin.users.accountOver', $user->id ) }}"
          class="nav-link {{ menuActive('admin.users.accountOver', 'active') }}">
          <span class="menu-title">@lang('Account')</span>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ route('admin.users.partner', $user->id ) }}"
          class="nav-link {{ menuActive('admin.users.partner', 'active') }}">
          <span class="menu-title">@lang('Partner')</span>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ route('admin.users.transaction', $user->id ) }}"
          class="nav-link {{ menuActive('admin.users.transaction', 'active') }}">
          <span class="menu-title">@lang('Transaction')</span>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ route('admin.users.direct_referrals', $user->id ) }}"
          class="nav-link {{ menuActive('admin.users.direct_referrals', 'active') }}">
          <span class="menu-title">@lang('Direct Referrals')</span>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ route('admin.users.network', $user->id ) }}"
          class="nav-link {{ menuActive('admin.users.network', 'active') }}">
          <span class="menu-title">@lang('Network')</span>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ route('admin.users.ticket', $user->id ) }}"
          class="nav-link {{ menuActive('admin.users.ticket', 'active') }}">
          <span class="menu-title">@lang('Tickets')</span>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ route('admin.users.add_note', $user->id ) }}"
          class="nav-link {{ menuActive('admin.users.add_note', 'active') }}">
          <span class="menu-title">@lang('Add Note')</span>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ route('admin.users.security', $user->id ) }}"
          class="nav-link {{ menuActive('admin.users.security', 'active') }}">
          <span class="menu-title">@lang('Security')</span>
        </a>
      </li>

    </ul>
  </div>


  <style>
    .nav-tabs .nav-item {
      margin-right: 15px;
      /* Adds space between the list items */
    }

    .nav-tabs .nav-link {
      font-size: 17px;
      /* Increases the font size of the links */
      padding: 10px 15px;
      /* Adjusts the padding for better spacing */
    }

    .nav-tabs .nav-link .menu-title {
      font-size: 15px;
      /* Increases the font size of the menu title */
    }
  </style>
