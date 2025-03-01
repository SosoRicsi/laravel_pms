<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Livewire\WithPagination;

class ListUsers extends Component
{
    use WithPagination;

    public function mount()
    {
        //
    }

    public function render()
    {
        return view('livewire.admin.list-users', [
            'users' => User::paginate(10)
        ]);
    }
}
