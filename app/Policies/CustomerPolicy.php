<?php

namespace App\Policies;

use App\Models\Customer;
use App\Models\User;

class CustomerPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->roles()->exists() || $user->can('view customers');
    }

    public function view(User $user, Customer $customer): bool
    {
        return $user->roles()->exists() || $user->can('view customers');
    }

    public function create(User $user): bool
    {
        return $user->roles()->exists() || $user->can('create customers');
    }

    public function update(User $user, Customer $customer): bool
    {
        return $user->roles()->exists() || $user->can('edit customers');
    }

    public function delete(User $user, Customer $customer): bool
    {
        return $user->roles()->exists() || $user->can('delete customers');
    }

    public function deleteAny(User $user): bool
    {
        return $user->roles()->exists() || $user->can('delete customers');
    }
}
