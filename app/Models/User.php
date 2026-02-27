<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Fortify\TwoFactorAuthenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'surname',
        'email',
        'password',
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'remember_token',
        'google_id',
        'google_token',
        'google_refresh_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn ($word) => Str::substr($word, 0, 1))
            ->implode('');
    }

    /**
     * Get all global roles for this user
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Get all projects this user has created
     */
    public function createdProjects()
    {
        return $this->hasMany(Project::class, 'user_id');
    }

    /**
     * Get all projects this user is assigned to
     */
    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_user')
                    ->withPivot('assignment_date', 'status')
                    ->withTimestamps();
    }

    /**
     * Get all project-specific roles for this user
     */
    public function projectRoles()
    {
        return $this->belongsToMany(ProjectRole::class, 'project_role_user');
    }

    /**
     * Check if user has a specific global role
     */
    public function hasRole(string $roleName): bool
    {
        return $this->roles()->where('name', $roleName)->exists();
    }

    /**
     * Check if user has any of the specified global roles
     */
    public function hasAnyRole($roleNames): bool
    {
        return $this->roles()->whereIn('name', (array) $roleNames)->exists();
    }

    /**
     * Check if user has all of the specified global roles
     */
    public function hasAllRoles($roleNames): bool
    {
        $roleNames = (array) $roleNames;
        return $this->roles()->whereIn('name', $roleNames)->count() === count($roleNames);
    }

    /**
     * Assign a global role to the user
     */
    public function assignRole(string $roleName)
    {
        $role = Role::firstOrCreate(['name' => $roleName]);
        $this->roles()->syncWithoutDetaching($role);
        return $this;
    }

    /**
     * Remove a global role from the user
     */
    public function removeRole(string $roleName)
    {
        $this->roles()->whereHas('role', fn($q) => $q->where('name', $roleName))->detach();
        return $this;
    }

    /**
     * Check if user has a specific role in a project
     */
    public function hasProjectRole(Project $project, string $roleName): bool
    {
        return $this->projectRoles()
                    ->whereHas('project', fn($q) => $q->where('id', $project->id))
                    ->where('project_roles.name', $roleName)
                    ->exists();
    }

    /**
     * Get all project roles for a specific project
     */
    public function getProjectRoles(Project $project)
    {
        return $this->projectRoles()
                    ->whereHas('project', fn($q) => $q->where('id', $project->id))
                    ->get();
    }
}
