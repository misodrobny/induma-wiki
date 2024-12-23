<x-layouts.app>
    <x-slot name="breadcrumb">
        <x-breadcrumbs :data="[
    'Documents' => null
]"/>
    </x-slot>
    <livewire:application.documents.table/>
</x-layouts.app>