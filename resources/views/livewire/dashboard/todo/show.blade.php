<?php

use App\Models\SimpleTasks;
use Livewire\Volt\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;

new #[Layout('layouts.app')] class extends Component {
    public Collection $completed_tasks, $pending_tasks;

    public string $error = '';

    public string $title = "Feladatok";

    public function mount()
    {
        $this->getUserTasks();
    }

    public function getUserTasks()
    {
        $this->completed_tasks = Auth::user()->simple_tasks->where('status', true);
        $this->pending_tasks = Auth::user()->simple_tasks->where('status', false);
    }

    public function markDone(int $task_id)
    {
        $task = SimpleTasks::with('owner')->find($task_id);
        if ($task->owner->id != Auth::id()) {
            $this->error = "Ezt a feladatot nem tudod szerkeszteni!";
            return;
        }

        try {
            $task->status = true;
            $task->save();

            $this->getUserTasks();
        } catch (\Exception $e) {
            $this->error = "Nem sikerült a feladatot frissíteni: {$e->getMessage()}";
        }
    }

    public function markPending(int $task_id)
    {
        $task = SimpleTasks::with('owner')->find($task_id);

        if ($task->owner->id != Auth::id()) {
            $this->error = "Ezt a feladatot nem tudod szerkeszteni!";
            return;
        }

        try {
            $task->status = false;
            $task->save();

            $this->getUserTasks();
        } catch (\Exception $e) {
            $this->error = "Nem sikerült a feladatot frissíteni: {$e->getMessage()}";
        }
    }
}; ?>

<div>
    <x-form.message-box type="{{ $error === '' ? '' : 'error' }}">{{ $error }}</x-form.message-box>
    @if ($pending_tasks->isNotEmpty())
        <table class="w-[750px] mx-auto bg-white text-black dark:bg-zinc-700 dark:text-white rounded-lg shadow-md mb-5" wire:poll.5s>
            <thead>
                <tr class="bg-zinc-200 text-2xl text-black dark:bg-zinc-700 dark:text-white text-center">
                    <th class="py-3 px-6" colspan="2">Nem Elkészült Feladatok</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pending_tasks as $todo)
                    <tr class="{{ $loop->last === true ?: 'border-b rounded-b-lg' }} border-zinc-300 dark:border-zinc-600 hover:bg-zinc-100 dark:hover:bg-zinc-600 justify-between w-full">
                        <td class="py-3 px-6">{{ $todo->title }}</td>
                        <td class="text-center w-[50px] mx-auto">
                            <x-form.checkbox :checked="$todo->status" :element="$todo->id" wire:click="markDone({{ $todo->id }})" />
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    @if ($completed_tasks->isNotEmpty())
        <table class="w-[750px] mx-auto bg-white text-black dark:bg-zinc-700 dark:text-white rounded-lg shadow-md mt-5" wire:poll.5s>
            <thead>
                <tr class="bg-zinc-200 text-2xl text-black dark:bg-zinc-700 dark:text-white text-center">
                    <th class="py-3 px-6" colspan="2">Elkészült Feladatok</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($completed_tasks as $todo)
                    <tr class="{{ $loop->last === true ?: 'border-b hover:rounded-b-lg' }} border-zinc-300 dark:border-zinc-600 hover:bg-zinc-100 dark:hover:bg-zinc-600 justify-between w-full">
                        <td class="py-3 px-6">{{ $todo->title }}</td>
                        <td class="text-center w-[50px] mx-auto">
                            <x-form.checkbox :checked="$todo->status" :element="$todo->id" wire:click="markPending({{ $todo->id }})" />
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
