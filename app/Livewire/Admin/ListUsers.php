<?php

declare(strict_types=1);

namespace App\Livewire\Admin;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

final class ListUsers extends Component
{
    use WithPagination;

    public array $status = [
        'success' => '',
        'error' => '',
    ];

    public array $loadingUsers = [];

    protected int $auth;

    public function mount()
    {
        $this->auth = Auth::id();
    }

    public function render()
    {
        return view('livewire.admin.list-users', [
            'users' => User::paginate(10),
        ]);
    }

    public function deleteUser($user_id)
    {
        $user_id = (int)$user_id;
        $this->setLoading($user_id, true);

        if (! $this->canDeleteUser($user_id)) {
            $this->setStatus(error: 'Nem törölheted a saját felhasználói fiókodat!');

            return;
        }

        try {
            $this->deleteUserById($user_id);
        } catch (Exception $e) {
            $this->setStatus(error: "Hiba történt a felhasználói fiók törlése közben: {$e->getMessage()}");
        } finally {
            $this->setLoading($user_id, false);
        }
    }

    public function editUser($user_id)
    {
        $user_id = (int)$user_id;
        $this->setLoading($user_id, true);

        $this->dispatch('admin.edit_user', $user_id);

        $this->setLoading($user_id, false);
    }

    protected function deleteUserById(int $user_id)
    {
        $user = User::findOrFail($user_id);
        $username = $user->name;
        $user->delete();

        $this->setStatus(success: "A felhasználó [{$username}] fiókja sikeresen törlésre került!");
    }

    protected function canDeleteUser(int $user_id): bool
    {
        return $user_id !== $this->auth;
    }

    protected function setStatus(string $success = '', string $error = '')
    {
        $this->status = compact($success, $error);
    }

    protected function setLoading(int $user_id, bool $status)
    {
        if ($status) {
            $this->loadingUsers[$user_id] = true;
        } else {
            unset($this->loadingUsers[$user_id]);
        }
    }
}
