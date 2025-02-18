<?php

namespace App\Policies;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class EmployeePolicy
{
    use HandlesAuthorization;

    public function view(User $user, Employee $Employee)
    {
        return $user->hasRole('HRD') || $user->hasRole('CEO');
    }

    public function create(User $user)
    {
        return $user->hasRole('HRD');
    }

    public function update(User $user, Employee $Employee)
    {
        return $user->hasRole('HRD');
    }

    public function delete(User $user, Employee $Employee)
    {
        return $user->hasRole('HRD');
    }
}
