<?php

namespace App\Policies;

use App\Models\Division;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class DivisionPolicy
{
    /**
     * Determine whether the user can view any models.
     */

    use HandlesAuthorization;

    public function view(User $user, Division $division)
    {
        return $user->hasRole('HRD') || $user->hasRole('CEO');
    }

    public function create(User $user)
    {
        return $user->hasRole('HRD');
    }

    public function update(User $user, Division $division)
    {
        return $user->hasRole('HRD');
    }

    public function delete(User $user, Division $division)
    {
        return $user->hasRole('HRD');
    }
}
