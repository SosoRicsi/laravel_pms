<?php

declare(strict_types=1);

namespace App\Livewire\Admin;

use App\Enums\UserRoles;
use App\Models\User;
use App\Rules\NotSameAsOld;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Component;

final class EditUser extends Component
{
    public bool $show_modal = false;

    public array $user_roles;

    public string $name = '';

    public string $role = '';

    public string $role_display_name = '';

    public ?int $user_id = null;

    protected ?User $user = null;

    protected $messages = [
        'role.required' => 'Válassz egy szerepkört.',
        'role.in' => 'Érvénytelen szerepkör.',
        'role.sameasold' => 'Az új rang nem lehet ugyan az, mint a régi.'
    ];

    public function render()
    {
        return view('livewire.admin.edit-user');
    }

    #[On('admin.edit_user')]
    public function datas($user)
    {
        $this->show_modal = true;

        $this->user = $user = User::find($user);
        $this->user_id = $user->id;
        $this->role = $user->role->value;
        $this->name = $user->name;
        $this->role_display_name = $user->role->display();

        $this->user_roles = UserRoles::list();
    }

    public function edit()
    {
        if (!Gate::authorize('admin')) {
            abort(403, "Nincs jogosúltságod a művelethez!");
        }

        $this->user = User::findOrFail($this->user_id);

        if (!$this->user) {
            abort(404, "A felhasználó nem található!");
        }

        $validated = $this->validate([
            'role' => ['required', 'in:' . UserRoles::implode(',') . '', new NotSameAsOld($this->user->role)],
        ]);

        $this->user->role = $this->role;

        $this->user->save();
    }

    public function toggleModal()
    {
        $this->show_modal = ! $this->show_modal;
    }
}
