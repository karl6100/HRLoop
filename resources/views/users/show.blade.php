<x-layouts.app :title="__('Users')">
    @livewire('user-form', ['user' => $user])
</x-layouts.app>