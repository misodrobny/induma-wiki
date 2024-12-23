<x-layouts.app>
    <x-slot name="breadcrumb">
        <x-breadcrumbs :data="[
    __('global.menu.documents') => route('application.documents.list'),
     __('global.menu.upload') => null
]"/>
    </x-slot>

    <livewire:application.documents.upload/>
</x-layouts.app>