<div>
    <div class="p-6" wire:poll>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white text-black dark:bg-zinc-800 dark:text-white rounded-lg shadow-md">
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
                        <tr class="border-b border-zinc-300 dark:border-zinc-700 hover:bg-zinc-100 dark:hover:bg-zinc-600">
                            <td class="py-3 px-6">{{ $user->name }}</td>
                            <td class="py-3 px-6">{{ $user->email }}</td>
                            <td class="py-3 px-6">{{ $user->role->display() }}</td>
                            <td class="py-3 px-6 text-right">
                                <button class="text-blue-600 hover:text-blue-500 dark:text-blue-400 dark:hover:text-blue-300 font-bold cursor-pointer">Szerkesztés</button>
                                <button class="ml-3 text-red-600 hover:text-red-500 dark:text-red-400 dark:hover:text-red-300 font-bold cursor-pointer">Törlés</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{ $users->links() }}
</div>
