<div>
    <form wire:submit.prevent="register" class="space-y-4">
        {{-- Email Field --}}
        <div class="flex items-center space-x-4">
            <label for="email" class="w-24 text-sm font-medium text-gray-900 dark:text-white">
                Email
            </label>
            <div class="flex flex-col">
                <input
                    type="email"
                    id="email"
                    wire:model="email"
                    class="w-80 p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50
                           focus:ring-blue-500 focus:border-blue-500
                           dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
                           dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @error('email')
                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>
        </div>

        {{-- Password Field --}}
        <div class="flex items-center space-x-4">
            <label for="password" class="w-24 text-sm font-medium text-gray-900 dark:text-white">
                Password
            </label>
            <div class="flex flex-col">
                <input
                    type="password"
                    id="password"
                    wire:model="password"
                    class="w-80 p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50
                           focus:ring-blue-500 focus:border-blue-500
                           dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
                           dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @error('password')
                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>
        </div>
        
        {{-- Submit Button --}}
        <div class="flex items-center">
            <span class="w-24"></span> {{-- Spacer to align with label width --}}
            @if($mode === 'edit')
            <button
                type="submit"
                class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300
                       font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                Register
            </button>
            @endif
        </div>
    </form>
</div>