@props(['action'])
@if ($general->metamask_login)
<x-flexible-view :view="$activeTemplate . 'user.auth.web3.metamask'" action="{{ $action }}"/>
@endif
