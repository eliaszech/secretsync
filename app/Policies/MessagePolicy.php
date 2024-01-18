<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class MessagePolicy
{

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user): bool
    {
        return $user->role == 'admin';
    }


    /**
     * Determine whether the user can view deleted models.
     *
     * @param User $user The user entity.
     *
     * @return bool True if the user can view deleted models, false otherwise.
     */
    public function viewDeleted(User $user): bool {
        return $user->role == 'admin';
    }
}
