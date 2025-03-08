<div>
    @if($status['error'] != "")
        <div class="bg-red-600 text-white max-w-md mx-auto p-3 rounded-2xl font-bold text-center">
            <p>{{ $status['error'] }}</p>
        </div>
    @elseif($status['success'] != "")
        <div class="bg-green-600 text-white max-w-md mx-auto p-3 rounded-2xl font-bold text-center">
            <p>{{ $status['success'] }}</p>
        </div>
    @endif

    <div class="p-6">
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white text-black dark:bg-zinc-800 dark:text-white rounded-lg shadow-md" wire:poll.5s>
                <thead>
                    <tr class="bg-zinc-200 text-black dark:bg-zinc-700 dark:text-white text-left">
                        <th class="py-3 px-6">Név</th>
                        <th class="py-3 px-6">Email</th>
                        <th class="py-3 px-6">Szerep</th>
                        <th class="py-3 px-6 text-right">Műveletek</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="{{ $loop->last === true ?: 'border-b' }} border-zinc-300 dark:border-zinc-700 hover:bg-zinc-100 dark:hover:bg-zinc-600">
                            <td class="py-3 px-6">{{ $user->name }}</td>
                            <td class="py-3 px-6">{{ $user->email }}</td>
                            <td class="py-3 px-6">{{ $user->role->display() }}</td>
                            <td class="py-3 px-6 text-right">
                                <div class="inline-block" wire:key="edit-btn-{{ $user->id }}">
                                    <button class="text-blue-600 hover:text-blue-500 dark:text-blue-400 dark:hover:text-blue-300 font-bold cursor-pointer" wire:click="editUser('{{ $user->id }}')" wire:loading.attr="disabled" wire:target="editUser" wire:loading.remove>Szerkesztés</button>
                                    <span wire:loading wire:target="editUser({{ $user->id }})" class="text-blue-500">Szerkesztés...</span>
                                </div>

                                @if($user->id != Auth::id())
                                    <div class="inline-block ml-3" wire:key="delete-btn-{{ $user->id }}">
                                        <button class="text-red-600 hover:text-red-500 dark:text-red-400 dark:hover:text-red-300 font-bold cursor-pointer" wire:click="deleteUser('{{ $user->id }}')" wire:loading.attr="disabled" wire:target="deleteUser" wire:loading.remove>Törlés</button>
                                        <span wire:loading wire:target="deleteUser" class="text-red-500">Törlés...</span>
                                    </div>
                                @else
                                    <div class="inline-block ml-3" wire:key="delete-btn-{{ $user->id }}">
                                        <button class="text-zinc-600 hover:text-red-500 dark:text-zinc-400 opacity-50 dark:hover:text-zinc-300 font-bold cursor-pointer">Nem törölhető</button>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{ $users->links() }}
</div>
