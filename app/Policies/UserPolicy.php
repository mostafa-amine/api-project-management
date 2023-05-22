<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function showAny(User $user)
    {
        return $user->hasRole(['admin', 'directeur']) ? true : false;
    }

    public function show(User $user)
    {
        return $user->hasRole('admin') ? true : false;
    }
}
