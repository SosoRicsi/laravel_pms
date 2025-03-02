<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class ListUsers extends Component
{
    use WithPagination;

    public array $status = [
        'success' => "",
        'error' => "",
    ];

    protected int $auth;
    public array $loadingUsers = []; // Itt tároljuk, mely felhasználók művelet alatt állnak

    public function mount()
    {
        $this->auth = Auth::id();
    }

    public function render()
    {
        return view('livewire.admin.list-users', [
            'users' => User::paginate(10)
        ]);
    }

    public function deleteUser($userId)
    {
        $this->loadingUsers[$userId] = true; // Indítás előtt beállítjuk
        $this->mount();

        try {
            $user = User::findOrFail($userId);
            if ($user->id === $this->auth) {
                $this->status = [
                    'success' => "",
                    'error' => "Nem törölheted a saját felhasználói fiókodat!"
                ];
                return;
            }

            $username = $user->name;
            $user->delete();
            $this->status = [
                'success' => "A felhasználó [{$username}] fiókja sikeresen törlésre került!",
                'error' => ""
            ];
        } catch (\Exception $e) {
            $this->status = [
                'success' => "",
                'error' => "Hiba történt a felhasználói fiók törlése közben: {$e->getMessage()}"
            ];
        } finally {
            unset($this->loadingUsers[$userId]);
        }
    }

    public function editUser($userId)
    {
        $this->loadingUsers[$userId] = true;

        // Itt lehet egy szerkesztő modal megnyitása vagy hasonló művelet

        unset($this->loadingUsers[$userId]);
    }
}
