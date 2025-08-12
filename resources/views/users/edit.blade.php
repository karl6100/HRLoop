<x-layouts.app :title="__('Users')">
    @livewire('user-form', ['user' => $user, 'mode' => 'edit'])
</x-layouts.app>