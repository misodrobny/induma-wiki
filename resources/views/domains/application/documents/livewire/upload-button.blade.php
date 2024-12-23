@aware(['component'])

@if ($component->isTailwind())
    <flux:tooltip content="Upload">
        <flux:button icon-trailing="arrow-up-tray" variant="primary" :loading="true" href="{{ route('application.document.upload') }}"></flux:button>
    </flux:tooltip>
@endif