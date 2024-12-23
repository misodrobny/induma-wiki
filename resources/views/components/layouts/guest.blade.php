<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'INDUMA Wiki') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <!-- Scripts -->
    @fluxStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
        x-data="{ pageLoaded: true }"
        class="font-sans text-gray-900 antialiased">

<div x-show="pageLoaded"
     x-init="window.addEventListener('DOMContentLoaded', () => {setTimeout(() => pageLoaded = false, 500)})"
     class="fixed left-0 top-0 z-[99999] flex h-screen w-screen items-center justify-center bg-black opacity-10">
    <div class="h-16 w-16 animate-spin rounded-full border-4 border-solid opacity-100 border-t-transparent">
    </div>
</div>

<div class="min-h-screen bg-gray-100 py-6 flex flex-col justify-center sm:py-12">
    {{ $slot }}
</div>

@fluxScripts
</body>
</html>
