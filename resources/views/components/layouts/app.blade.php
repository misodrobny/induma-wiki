<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'INDUMA Wiki' }}</title>

    @livewireStyles
    @fluxStyles
    @vite(['resources/css/app.css'])
</head>

<body class="min-h-screen bg-white dark:bg-zinc-800">
<flux:sidebar sticky stashable class="bg-zinc-50 dark:bg-zinc-900 border-r border-zinc-200 dark:border-zinc-700">
    <flux:sidebar.toggle class="lg:hidden" icon="x-mark"/>

    <a href="{{ route('application.dashboard') }}" data-flux-brand>
        <div class="h-10 rounded overflow-hidden shrink-0">
            <img src="{{ asset('images/logo_induma.webp') }}" alt="Logo" class="h-10"/>
        </div>
    </a>

    <flux:navlist variant="outline">
        <flux:navlist.item icon="home"
                           href="{{ route('application.dashboard') }}"
                           :current="Route::is('application.dashboard')">{{ __('global.menu.home') }}
        </flux:navlist.item>
        <flux:navlist.item icon="document-text"
                           href="{{ route('application.documents.list') }}"
                           :current="str_contains(Route::currentRouteName(), 'application.document')">{{ __('global.menu.documents') }}
        </flux:navlist.item>

    </flux:navlist>

    <flux:spacer/>

    <flux:navlist variant="outline">
        <flux:navlist.item icon="information-circle" href="#">{{ __('global.menu.help') }}</flux:navlist.item>
        <flux:navlist.item>{{ ApplicationVersion::getFormatedVersion() }}</flux:navlist.item>
    </flux:navlist>

</flux:sidebar>

<flux:header container class="bg-zinc-50 dark:bg-zinc-900 border-b border-zinc-200 dark:border-zinc-700">
    <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left"/>

    <flux:spacer/>

    @include('components.language')

    <flux:dropdown position="top" align="start">
        <flux:profile avatar="{{ asset('images/avatar.png') }}"></flux:profile>
        <flux:menu>
            <flux:menu.item href="{{ route('application.profile') }}">{{ auth()->user()->getFullname() }}</flux:menu.item>

            <flux:menu.separator />

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <flux:menu.item type="submit" icon="arrow-right-start-on-rectangle">{{ __('global.logout') }}</flux:menu.item>
            </form>
        </flux:menu>
    </flux:dropdown>
</flux:header>

<flux:main class="!p-3 lg:!p-4">
    {{ $breadcrumb ?? '' }}
    {{ $slot }}
</flux:main>

@persist('toast')
<flux:toast />
@endpersist

@livewireScripts
@fluxScripts
@vite(['resources/js/app.js'])
@stack('scripts')
</body>
</html>
