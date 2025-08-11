<x-layouts.app :title="__('Users')">
    @livewire('user-form', ['id' => $user->id])
</x-layouts.app>