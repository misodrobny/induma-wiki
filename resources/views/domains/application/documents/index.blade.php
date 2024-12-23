<x-layouts.app>
    <x-slot name="breadcrumb">
        <x-breadcrumbs :data="[
    __('global.menu.documents') => null
]"/>
    </x-slot>
    <livewire:application.documents.table/>
</x-layouts.app>