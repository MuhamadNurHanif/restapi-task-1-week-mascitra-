<?php

namespace App\Policies;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any roles.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasRole('CEO') || $user->hasRole('HRD');
    }

    /**
     * Determine whether the user can view a specific role.
     */
    public function view(User $user, Role $role): bool
    {
        return $user->hasRole('CEO') || $user->hasRole('HRD');
    }

    /**
     * Determine whether the user can create roles.
     */
    public function create(User $user): bool
    {
        return $user->hasRole('HRD'); // Hanya HRD yang bisa create
    }

    /**
     * Determine whether the user can update roles.
     */
    public function update(User $user, Role $role): bool
    {
        return $user->hasRole('HRD'); // Hanya HRD yang bisa update
    }

    /**
     * Determine whether the user can delete roles.
     */
    public function delete(User $user, Role $role): bool
    {
        return $user->hasRole('HRD'); // Hanya HRD yang bisa delete
    }

    /**
     * Determine whether the user can bulk delete roles.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasRole('HRD');
    }

    /**
     * Determine whether the user can permanently delete a role.
     */
    public function forceDelete(User $user, Role $role): bool
    {
        return false; // Nonaktifkan fitur force delete
    }

    /**
     * Determine whether the user can permanently bulk delete roles.
     */
    public function forceDeleteAny(User $user): bool
    {
        return false; // Nonaktifkan fitur force delete
    }

    /**
     * Determine whether the user can restore a deleted role.
     */
    public function restore(User $user, Role $role): bool
    {
        return false; // Nonaktifkan fitur restore
    }

    /**
     * Determine whether the user can bulk restore deleted roles.
     */
    public function restoreAny(User $user): bool
    {
        return false; // Nonaktifkan fitur restore
    }

    /**
     * Determine whether the user can replicate a role.
     */
    public function replicate(User $user, Role $role): bool
    {
        return false; // Nonaktifkan fitur replicate
    }

    /**
     * Determine whether the user can reorder roles.
     */
    public function reorder(User $user): bool
    {
        return false; // Nonaktifkan fitur reorder
    }
}
