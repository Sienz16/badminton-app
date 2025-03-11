@php
    $role = auth()->user()->role_id;
@endphp

@if($role === 'admin')
    {{-- Admin gets sidebar layout --}}
    <x-layouts.app.sidebar :title="$title ?? null">
        <flux:main>
            {{ $slot }}
        </flux:main>
    </x-layouts.app.sidebar>
@else
    {{-- Players and Umpires get header layout --}}
    <x-layouts.app.header :title="$title ?? null">
        <flux:main>
            {{ $slot }}
        </flux:main>
    </x-layouts.app.header>
@endif
