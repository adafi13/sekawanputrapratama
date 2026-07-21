<?php

namespace App\Policies;

use App\Models\Quotation;
use App\Models\User;

class QuotationPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->roles()->exists() || $user->can('view quotations');
    }

    public function view(User $user, Quotation $quotation): bool
    {
        return $user->roles()->exists() || $user->can('view quotations');
    }

    public function create(User $user): bool
    {
        return $user->roles()->exists() || $user->can('create quotations');
    }

    public function update(User $user, Quotation $quotation): bool
    {
        return $user->roles()->exists() || $user->can('edit quotations');
    }

    public function delete(User $user, Quotation $quotation): bool
    {
        return $user->roles()->exists() || $user->can('delete quotations');
    }

    public function deleteAny(User $user): bool
    {
        return $user->roles()->exists() || $user->can('delete quotations');
    }
}
