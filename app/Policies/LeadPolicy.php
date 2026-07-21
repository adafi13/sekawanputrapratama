<?php

namespace App\Policies;

use App\Models\Lead;
use App\Models\User;

class LeadPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->roles()->exists() || $user->can('view leads');
    }

    public function view(User $user, Lead $lead): bool
    {
        return $user->roles()->exists() || $user->can('view leads');
    }

    public function create(User $user): bool
    {
        return $user->roles()->exists() || $user->can('create leads');
    }

    public function update(User $user, Lead $lead): bool
    {
        return $user->roles()->exists() || $user->can('edit leads');
    }

    public function delete(User $user, Lead $lead): bool
    {
        return $user->roles()->exists() || $user->can('delete leads');
    }

    public function deleteAny(User $user): bool
    {
        return $user->roles()->exists() || $user->can('delete leads');
    }
}
