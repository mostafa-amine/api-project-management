<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Organization;

class OrganizationPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasRole(['secretaire', 'directeur', 'admin']) ? true : false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user): bool
    {
        return $user->hasRole(['secretaire', 'directeur', 'admin']) ? true : false;
    }

    /**
     * Determine whether the user can store models.
     */
    public function store(User $user): bool
    {
        return $user->hasRole(['secretaire', 'admin']) ? true : false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user): bool
    {
        return $user->hasRole(['secretaire', 'directeur', 'admin']) ? true : false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user): bool
    {
        return $user->hasRole(['directeur', 'admin']) ? true : false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Organization $organization): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Organization $organization): bool
    {
        //
    }
}
