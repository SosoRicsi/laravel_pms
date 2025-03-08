<?php

declare(strict_types=1);

namespace App\Livewire\Admin;

use App\Enums\UserRoles;
use App\Models\User;
use Exception;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;

final class CreateNewUser extends Component
{
    public array $user_roles;

    public array $status;

    public string $email = '';

    public string $password = '';

    public string $confirm_password = '';

    public string $name = '';

    public string $role = '';

    public bool $show_create_user_form = false;

    protected $messages = [
        'email.required' => 'Az e-mail megadása kötelező.',
        'email.email' => 'Érvényes e-mail címet adj meg.',
        'email.unique' => 'Ez az e-mail már foglalt.',
        'password.required' => 'A jelszó megadása kötelező.',
        'password.min' => 'A jelszónak legalább 8 karakter hosszúnak kell lennie.',
        'password.letters' => 'A jelszónak tartalmaznia kell legalább egy betűt.',
        'password.numbers' => 'A jelszónak tartalmaznia kell legalább egy számot.',
        'confirm_password.required' => 'Erősítsd meg a jelszót.',
        'confirm_password.same' => 'A jelszavak nem egyeznek.',
        'name.required' => 'A teljes név megadása kötelező.',
        'name.min' => 'A névnek legalább 3 karakter hosszúnak kell lennie.',
        'name.max' => 'A név nem lehet hosszabb 255 karakternél.',
        'role.required' => 'Válassz egy szerepkört.',
        'role.in' => 'Érvénytelen szerepkör.',
    ];

    public function mount()
    {
        $this->user_roles = UserRoles::list();
        $this->status = [
            'created' => false,
            'user' => '',
        ];
    }

    public function render()
    {
        return view('livewire.admin.create-new-user');
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', Password::defaults()],
            'confirm_password' => ['required', 'same:password'],
            'role' => ['required', 'in:'.UserRoles::implode(',').''],
        ];
    }

    public function createUser()
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', Password::defaults()],
            'confirm_password' => ['required', 'same:password'],
            'role' => ['required', 'in:'.UserRoles::implode(',').''],
        ]);

        try {
            $new_user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => $validated['password'],
                'role' => UserRoles::from($validated['role']),
            ]);

            $this->status = [
                'created' => true,
                'user' => $new_user->name,
            ];

        } catch (Exception $e) {
            dd($e->getMessage());
        }

    }

    public function toggleCreateUserForm()
    {
        $this->show_create_user_form = ! $this->show_create_user_form;
    }
}
