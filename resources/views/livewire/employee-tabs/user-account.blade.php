<fieldset @if($mode==='view' ) disabled @endif>
    @livewire('register-employee-user', ['mode' => $mode])
</fieldset>