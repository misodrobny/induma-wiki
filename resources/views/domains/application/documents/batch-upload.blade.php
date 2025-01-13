<x-layouts.app>
    <x-slot name="breadcrumb">
        <x-breadcrumbs :data="[
    __('global.menu.documents') => route('application.documents.list'),
     __('global.menu.batch_upload') => null
]"/>
    </x-slot>

    <livewire:application.documents.batch-upload/>

</x-layouts.app>