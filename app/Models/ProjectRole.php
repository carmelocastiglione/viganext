<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectRole extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectRoleFactory> */
    use HasFactory;

    protected $fillable = [
        'project_id',
        'name',
        'description',
    ];

    protected $table = 'project_roles';

    /**
     * Get the project this role belongs to
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Get all users with this project role
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'project_role_user');
    }
}
