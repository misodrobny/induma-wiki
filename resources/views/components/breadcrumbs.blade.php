<flux:breadcrumbs class="!mb-2">
    <flux:breadcrumbs.item href="{{ route('application.dashboard') }}" icon="home" class="ms-2" />
    @if (isset($data) && is_array($data))
        @foreach($data as $name => $href)
            @if ($href)
                <flux:breadcrumbs.item href="{{ $href }}">{{ $name }}</flux:breadcrumbs.item>
            @else
                <flux:breadcrumbs.item>{{ $name }}</flux:breadcrumbs.item>
            @endif
        @endforeach
    @endif
</flux:breadcrumbs>
<flux:separator class="mb-4" />
