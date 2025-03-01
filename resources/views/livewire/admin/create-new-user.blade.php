<div>
    @if($status['created'])
        <div class="bg-green-900 mx-auto max-w-md p-3 font-bold rounded-2xl mb-4">
            <p>Új felhasználó [{{ $status['user'] }}] létrehozva!</p>
        </div>
    @endif
    @if($show_create_user_form)
        <div class="bg-zinc-900 mx-auto max-w-md p-5 rounded-2xl">
            <form class="max-w-md mx-auto" wire:submit.prevent="createUser" autocomplete="off">
                <div class="relative z-0 w-full mb-5 group">
                    <input autocomplete="off" type="email" wire:model="email" name="floating_email" id="floating_email" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer cursor-text" placeholder=" "  />
                    <label for="floating_email" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">E-mail cím</label>
                    @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input type="password" wire:model="password" name="floating_password" id="floating_password" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer cursor-text" placeholder=" "  />
                    <label for="floating_password" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Jelszó</label>
                    @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input type="password" wire:model="confirm_password" name="repeat_password" id="floating_repeat_password" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer cursor-text" placeholder=" "  />
                    <label for="floating_repeat_password" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Jelszó újra</label>
                    @error('confirm_password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input type="text" wire:model="name" name="floating_last_name" id="floating_last_name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer cursor-text" placeholder=" " />
                    <label for="floating_last_name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Teljes név</label>
                    @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div x-data="{ openSelect: false, selected: '', selected_role: '' }" class="relative z-50 w-full mb-5 group">
                    <div class="relative">
                        <button type="button" @click="openSelect = !openSelect" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer flex justify-between items-center cursor-pointer">
                            <span x-text="selected || 'Válassz egy lehetőséget'" class="text-gray-500 dark:text-gray-400"></span>
                            <span class="text-gray-500 dark:text-gray-400">▼</span>
                        </button>
                        <ul x-show="openSelect" x-transition.opacity x-cloak @click.away="openSelect = false" class="absolute w-full mt-1 bg-gray-800 text-white border border-gray-600 rounded-md shadow-lg overflow-hidden z-50">
                            @foreach ($user_roles as $role)
                                <li wire:click="$set('role', '{{ $role['value'] }}')" @click="selected = '{{ $role['display'] }}'; openSelect = false" class="px-4 py-2 hover:bg-gray-700 cursor-pointer">{{ $role['display'] }}</li>
                            @endforeach
                        </ul>

                    </div>
                    <input type="hidden" wire:model="role" name="role" x-model="selected_role">
                </div>
                <div class="flex flex-row justify-end">
                    <flux:button wire:click="toggleCreateUserForm()" class="cursor-pointer" style="background-color: transparent; border: none; font-weight: bold">Bezárás</flux:button>
                    <flux:button type="submit" class="cursor-pointer ms-3" style="z-index: 1">Létrehozás</flux:button>
                </div>
            </form>
        </div>
    @else
        <div class="flex justify-center">
            <flux:button wire:click="toggleCreateUserForm()" class="cursor-pointer" style="font-weight: bold">Új Felhasználó Létrehozása</flux:button>
        </div>
    @endif
</div>
