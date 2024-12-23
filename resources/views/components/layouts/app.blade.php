<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'INDUMA LLM Data Preprocessor' }}</title>

    @livewireStyles
    @fluxStyles
    @vite(['resources/css/app.css'])
</head>

<body class="min-h-screen bg-white dark:bg-zinc-800">
<flux:sidebar sticky stashable class="bg-zinc-50 dark:bg-zinc-900 border-r border-zinc-200 dark:border-zinc-700">
    <flux:sidebar.toggle class="lg:hidden" icon="x-mark"/>

    <flux:brand href="{{ route('application.dashboard') }}" name="INDUMA s.a.s." class="px-2 dark:hidden"/>
    <flux:brand href="{{ route('application.dashboard') }}" name="INDUMA s.a.s." class="px-2 hidden dark:flex"/>

    <flux:navlist variant="outline">
        <flux:navlist.item icon="home"
                           href="{{ route('application.dashboard') }}"
                           :current="Route::is('application.dashboard')">Home
        </flux:navlist.item>
        <flux:navlist.item icon="document-text"
                           href="{{ route('application.documents.list') }}"
                           :current="str_contains(Route::currentRouteName(), 'application.document')">Documents
        </flux:navlist.item>

    </flux:navlist>

    <flux:spacer/>

    <flux:navlist variant="outline">
        <flux:navlist.item icon="information-circle" href="#">Help</flux:navlist.item>
    </flux:navlist>

</flux:sidebar>

<flux:header container class="bg-zinc-50 dark:bg-zinc-900 border-b border-zinc-200 dark:border-zinc-700">
    <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left"/>

    <flux:spacer/>

    <flux:dropdown position="top" alignt="start">
        <flux:profile avatar=""/>

        <flux:menu>
            <flux:menu.item icon="arrow-right-start-on-rectangle">Logout</flux:menu.item>
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
