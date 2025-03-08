<div>
    @if ($show_modal)
        <div class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
            <div class="max-w-md p-5 bg-zinc-100 dark:bg-zinc-700 rounded-2xl shadow-lg">
                <div class="text-center">
                    <h1 class="text-xl"><span class="font-bold text-2xl">{{ $name }}</span> felhsaználó rangja:</h1>
                </div>
                <form class="max-w-md mx-auto" wire:submit.prevent="edit" autocomplete="off">
                    <div x-data="{ openSelect: false, selected: '{{ $role_display_name }}', selected_role: '{{ $role }}' }" class="relative z-50 w-full mb-5 group">
                        <div class="relative">
                            <button type="button" @click="openSelect = !openSelect" class="block py-2.5 px-0 w-full text-sm text-zinc-900 bg-transparent border-0 border-b-2 border-zinc-300 dark:text-white dark:border-zinc-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer flex justify-between items-center cursor-pointer">
                                <span x-text="selected || 'Válassz egy lehetőséget'" class="text-zinc-500 dark:text-zinc-400"></span>
                                <span class="text-zinc-500 dark:text-zinc-400">▼</span>
                            </button>
                            <ul x-show="openSelect" x-transition.opacity x-cloak @click.away="openSelect = false" class="absolute w-full mt-1 bg-white dark:bg-zinc-800 text-zinc-800 dark:text-white border border-zinc-100 dark:border-zinc-600 rounded-md shadow-lg overflow-hidden z-50">
                                @foreach ($user_roles as $role)
                                    <li wire:click="$set('role', '{{ $role['value'] }}')" @click="selected = '{{ $role['display'] }}'; openSelect = false" wire:model="role" class="px-4 py-2 hover:bg-zinc-100 dark:hover:bg-zinc-700 cursor-pointer">{{ $role['display'] }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @error('role') <p>{{ $message }}</p> @enderror
                        <input type="hidden" wire:model="role" name="role" x-model="selected_role">
                        <input type="hidden" wire:model="user_id" name="user_id">
                    </div>
                    <div class="flex flex-row justify-end">
                        <flux:button wire:click="toggleModal()" class="cursor-pointer" style="border: none; box-shadow: none; font-weight: bold;">Bezárás</flux:button>
                        <flux:button type="submit" class="cursor-pointer ms-3" style="z-index: 1">Módosítás</flux:button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
