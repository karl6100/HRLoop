<div>
    @if($view === 'list')
    <button
        wire:click="toggle"
        class="p-1 rounded-md {{ $deactivate ? 'hover:bg-green-100 dark:hover:bg-green-900' : 'hover:bg-red-100 dark:hover:bg-red-900' }} "
        title="{{ $deactivate ? 'Activate' : 'Deactivate' }}">
        @if($deactivate) 
        {{-- Gray inactive SVG --}}
        <svg xmlns="http://www.w3.org/2000/svg"
            width="28"
            height="28"
            viewBox="0 0 24 24"
            fill="none"
            stroke="#4CAF50"
            stroke-width="1"
            stroke-linecap="round"
            stroke-linejoin="round">
            <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
            <path d="M6 21v-2a4 4 0 0 1 4 -4h4" />
            <path d="M15 19l2 2l4 -4" />
        </svg>
        @else
        {{-- Green check SVG --}}
        <svg xmlns="http://www.w3.org/2000/svg"
            width="28" height="28"
            viewBox="0 0 24 24"
            fill="none"
            stroke="#ff3b30"
            stroke-width="1.5"
            stroke-linecap="round"
            stroke-linejoin="round">
            <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
            <path d="M6 21v-2a4 4 0 0 1 4 -4h3.5" />
            <path d="M19 19m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
            <path d="M17 21l4 -4" />
        </svg>
        @endif
    </button>
    @else
    <button
        wire:click="toggle"
        class="px-3 py-1 rounded text-white {{ $deactivate ? 'bg-green-600' : 'bg-red-600' }}">
        {{ $deactivate ? 'Activate' : 'Deactivate' }}
    </button>
    @endif
</div>