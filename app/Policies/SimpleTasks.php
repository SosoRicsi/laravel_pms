<?php

namespace App\Policies;

use App\Models\SimpleTasks as Todos;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SimpleTasks
{

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Todos $todo): bool
    {
        return $todo->user_id === $user->id;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Todos $todo): bool
    {
        return $todo->user_id === $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Todos $todo): bool
    {
        return $todo->user_id === $user->id;
    }

}
