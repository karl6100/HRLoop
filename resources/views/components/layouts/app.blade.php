<x-layouts.app.sidebar :title="$title ?? null">
    <flux:main>
        @livewireStyles
        {{ $slot }}
        @livewireScripts
    </flux:main>
</x-layouts.app.sidebar>