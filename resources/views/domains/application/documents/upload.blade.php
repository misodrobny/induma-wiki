<x-layouts.app>
    <x-slot name="breadcrumb">
        <x-breadcrumbs :data="[
    'Documents' => route('application.documents.list'),
    'Upload' => null
]"/>
    </x-slot>

    <livewire:application.documents.upload/>
</x-layouts.app>