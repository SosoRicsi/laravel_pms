<?php

use App\Models\SimpleTasks;
use Livewire\Volt\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

/**
 * Livewire Volt component for creating a new SimpleTask.
 */
new class extends Component {

    /**
     * @var string $title SimpleTask title
     */
    public string $title = "";

    /**
     * @var array<string, string> Validation error messages
     */
    protected $messages = [
        'title.required' => "Nem hagyhatod üresen a mezőt!",
        'title.min' => "A címnek minimum :min karakterből kell álnia!",
        'title.max' => "A cím nem lehet hosszabb :max karakternél!"
    ];

    /**
     * @var array<string, mixed> Validation rules
     */
    protected $rules = [
        'title' => [
            'required',
            'string',
            'min:3',
            'max:255'
        ]
    ];

    /**
     * Function to create a new SimpleTask.
     * ----------------------------------------
     * After successfull validation, a new task is created for the authenticated user.
     * Once created, a Livewire event is dispatched to refresh the table.
     *
     * @return void
     */
    public function create(): void
    {
        $validated = $this->validate();

        $task = SimpleTasks::create([
            'user_id' => Auth::id(),
            'title' => $validated['title']
        ]);

        $this->title = "";
        $this->dispatch('todos.reload_table');
    }
}; ?>

<div>
    <form class="max-w-lg mx-auto my-3 flex justify-between gap-3 bg-zinc-100 dark:bg-zinc-700 p-3 rounded-lg" wire:submit.prevent="create">
        <div class="relative z-0 w-full mb-5 group">
            <input autocomplete="off" type="text" wire:model="title" name="floating_title" id="floating_title" class="block py-2.5 px-0 w-full text-sm text-zinc-900 bg-transparent border-0 border-b-2 border-zinc-300 appearance-none dark:text-white dark:border-zinc-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer cursor-text" placeholder=" "  />
            <label for="floating_title" class="peer-focus:font-medium absolute text-sm text-zinc-500 dark:text-zinc-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Feladat cím</label>
            @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        <div class="flex justify-end">
            <x-form.button size="base">Létrehozás</x-form.button>
        </div>
    </form>
</div>
