<flux:dropdown position="bottom" align="end">
    <flux:button icon-trailing="chevron-down" variant="ghost">
        @switch(App::getLocale())
            @case('en') <i class="fi fi-us"></i> @break
            @case('es') <i class="fi fi-co"></i> @break
        @endswitch
    </flux:button>

    <flux:navmenu>
        <flux:navmenu.item href="{{ route('language', ['locale' => 'es']) }}">
            <i class="fi fi-co me-2"></i> {{ __('global.language.es') }}
        </flux:navmenu.item>
        <flux:navmenu.item href="{{ route('language', ['locale' => 'en']) }}">
            <i class="fi fi-us me-2"></i> {{ __('global.language.en') }}
        </flux:navmenu.item>
    </flux:navmenu>
</flux:dropdown>