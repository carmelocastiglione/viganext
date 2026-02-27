<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;

class ProjectPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasRole('admin') || $user->projects()->exists();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Project $project): bool
    {
        return $user->hasRole('admin') 
            || $project->user_id === $user->id
            || $project->users()->where('user_id', $user->id)->exists();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasAnyRole(['admin', 'teacher']);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Project $project): bool
    {
        return $user->hasRole('admin') || $project->user_id === $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Project $project): bool
    {
        return $user->hasRole('admin') || $project->user_id === $user->id;
    }

    /**
     * Determine whether the user can assign users to the project.
     */
    public function assignUsers(User $user, Project $project): bool
    {
        return $user->hasRole('admin') || $project->user_id === $user->id;
    }

    /**
     * Determine whether the user can manage roles in the project.
     */
    public function manageRoles(User $user, Project $project): bool
    {
        return $user->hasRole('admin') || $project->user_id === $user->id;
    }
}
