<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'user_id',
    ];

    /**
     * Get the user who created the project
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get all users assigned to this project
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'project_user')
                    ->withPivot('assignment_date', 'status')
                    ->withTimestamps();
    }

    /**
     * Get all roles available in this project
     */
    public function roles()
    {
        return $this->hasMany(ProjectRole::class);
    }

    /**
     * Get users with a specific role in this project
     */
    public function getUsersByRole($roleName)
    {
        return $this->users()
                    ->whereHas('projectRoles', function ($query) use ($roleName) {
                        $query->where('project_roles.name', $roleName)
                              ->where('project_roles.project_id', $this->id);
                    })
                    ->get();
    }

    /**
     * Assign a user to this project with a specific role
     */
    public function assignUser(User $user, ProjectRole $role, $assignmentDate = null)
    {
        // Attach user to project if not already attached
        if (!$this->users()->where('user_id', $user->id)->exists()) {
            $this->users()->attach($user->id, [
                'assignment_date' => $assignmentDate ?? now(),
            ]);
        }

        // Attach project role to user
        $user->projectRoles()->attach($role->id);
    }

    /**
     * Remove a user from a specific project role
     */
    public function removeUserFromRole(User $user, ProjectRole $role)
    {
        $user->projectRoles()->detach($role->id);

        // Remove user from project if no roles remain
        $hasRoles = $user->projectRoles()
                        ->whereHas('project', fn($q) => $q->where('id', $this->id))
                        ->exists();

        if (!$hasRoles) {
            $this->users()->detach($user->id);
        }
    }
}
