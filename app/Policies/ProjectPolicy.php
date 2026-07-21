<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;

class ProjectPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->roles()->exists() || $user->can('view projects');
    }

    public function view(User $user, Project $project): bool
    {
        return $user->roles()->exists() || $user->can('view projects');
    }

    public function create(User $user): bool
    {
        return $user->roles()->exists() || $user->can('create projects');
    }

    public function update(User $user, Project $project): bool
    {
        return $user->roles()->exists() || $user->can('edit projects');
    }

    public function delete(User $user, Project $project): bool
    {
        return $user->roles()->exists() || $user->can('delete projects');
    }

    public function deleteAny(User $user): bool
    {
        return $user->roles()->exists() || $user->can('delete projects');
    }
}
