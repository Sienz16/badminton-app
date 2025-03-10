@php
    $role = auth()->user()->role_id;
@endphp

@if($role === 'admin')
    <x-navigation.admin-nav />
@elseif($role === 'umpire')
    <x-navigation.umpire-nav />
@else
    <x-navigation.player-nav />
@endif