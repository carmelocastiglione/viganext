<?php

/**
 * USAGE EXAMPLES FOR MULTI-ROLE AND MULTI-PROJECT SYSTEM
 * 
 * This file demonstrates how to use the new role and project system.
 */

// ====================
// GLOBAL ROLES MANAGEMENT
// ====================

// Assign a global role to a user
$user->assignRole('admin');
$user->assignRole('teacher');
$user->assignRole('student');

// Check if user has a role
if ($user->hasRole('admin')) {
    // User is admin
}

// Check if user has any of the roles
if ($user->hasAnyRole(['admin', 'teacher'])) {
    // User is either admin or teacher
}

// Check if user has all roles
if ($user->hasAllRoles(['admin', 'teacher'])) {
    // User is both admin and teacher
}

// Remove a global role
$user->removeRole('student');

// Get all global roles for a user
$roles = $user->roles; // Collection of Role models


// ====================
// PROJECT MANAGEMENT
// ====================

// Create a project (creator becomes the owner)
$project = Project::create([
    'name' => 'Math Course',
    'description' => 'A comprehensive math course',
    'user_id' => $user->id,
]);

// Get all projects for a user
$userProjects = $user->projects; // Collection of Project models

// Get the project creator
$creator = $project->creator;


// ====================
// PROJECT ROLES MANAGEMENT
// ====================

// Create roles for a project
$responsibleRole = ProjectRole::create([
    'project_id' => $project->id,
    'name' => 'responsible',
    'description' => 'Person responsible for the project',
]);

$helperRole = ProjectRole::create([
    'project_id' => $project->id,
    'name' => 'helper',
    'description' => 'Helper for the project',
]);

$coordinatorRole = ProjectRole::create([
    'project_id' => $project->id,
    'name' => 'coordinator',
    'description' => 'Project coordinator',
]);

$viewerRole = ProjectRole::create([
    'project_id' => $project->id,
    'name' => 'viewer',
    'description' => 'Can only view project',
]);


// ====================
// ASSIGNING USERS TO PROJECTS WITH ROLES
// ====================

// Assign user to project with multiple roles (flexible approach)
$project->assignUser($teacher, $responsibleRole, now());
$project->assignUser($teacher, $coordinatorRole);

// Or manually (more control):
// 1. Add user to project
$project->users()->attach($teacher->id, ['assignment_date' => now()]);
// 2. Add project role(s) to user in that project
$teacher->projectRoles()->attach($responsibleRole->id);
$teacher->projectRoles()->attach($coordinatorRole->id);

// Get all users assigned to a project
$projectUsers = $project->users; // Collection of User models

// Get all users with a specific role in a project
$responsibleUsers = $project->getUsersByRole('responsible');
$helperUsers = $project->getUsersByRole('helper');

// Check if user has a role in a project
$isResponsible = $user->hasProjectRole($project, 'responsible');
$isHelper = $user->hasProjectRole($project, 'helper');

// Get all project roles for a user in a specific project
$userRolesInProject = $user->getProjectRoles($project); // Collection of ProjectRole models

// Get all project roles a user has (across all projects)
$allProjectRoles = $user->projectRoles;


// ====================
// REMOVING USERS FROM PROJECT ROLES
// ====================

// Remove user from a specific project role
$project->removeUserFromRole($user, $responsibleRole);
// Note: User is automatically removed from project if no roles remain

// Or manually prevent auto-removal:
$user->projectRoles()->detach($responsibleRole->id);


// ====================
// QUERY EXAMPLES
// ====================

// Get all projects where user is responsible
$responsibleProjects = $user->projects()
    ->whereHas('roles', function ($query) {
        $query->where('project_roles.name', 'responsible')
              ->whereHas('users', fn($q) => $q->where('user_id', auth()->id()));
    })
    ->get();

// Get all teachers across all projects
$teachers = User::whereHas('roles', fn($q) => $q->where('name', 'teacher'))->get();

// Get all users in a project grouped by role
$projectUsersGrouped = $project->roles()
    ->with('users')
    ->get()
    ->mapWithKeys(fn($role) => [
        $role->name => $role->users
    ]);

// Get projects where user has a specific role
$helperProjects = $user->projectRoles()
    ->where('name', 'helper')
    ->with('project')
    ->get()
    ->pluck('project');


// ====================
// AUTHORIZATION EXAMPLES
// ====================

// Using policies
if ($user->can('view', $project)) {
    // Show project details
}

if ($user->can('update', $project)) {
    // Show edit button
}

if ($user->can('assignUsers', $project)) {
    // Show user assignment controls
}

if ($user->can('manageRoles', $project)) {
    // Show role management controls
}
