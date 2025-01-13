<x-layouts.app>
    <x-slot name="breadcrumb">
        <x-breadcrumbs :data="[]"/>
    </x-slot>

    <ul role="list" class="grid grid-cols-1 gap-x-6 gap-y-8 lg:grid-cols-3 xl:gap-x-8">
        <li class="overflow-hidden rounded-xl border border-gray-200">
            <div class="flex items-center gap-x-4 border-b border-gray-900/5 bg-gray-50 p-6">
                <img src="https://tailwindui.com/plus/img/logos/48x48/tuple.svg" alt="Tuple" class="size-12 flex-none rounded-lg bg-white object-cover ring-1 ring-gray-900/10">
                <div class="text-sm/6 font-medium text-gray-900">{{ __('global.menu.documents') }}</div>
            </div>
            <dl class="-my-3 divide-y divide-gray-100 px-6 py-4 text-sm/6">
                <div class="flex justify-between gap-x-4 py-3">
                    <dt class="text-gray-500">{{ __('application.pages.dashboard.widgets.total_number_of_documents') }}</dt>
                    <dd class="flex items-start gap-x-2">
                        <div class="font-medium text-gray-900">{{ \App\Domains\Application\Documents\Models\Document::query()->count() }}</div>
                    </dd>
                </div>
            </dl>
        </li>
    </ul>

</x-layouts.app>