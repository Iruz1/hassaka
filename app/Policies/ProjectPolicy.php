<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;

class ProjectPolicy
{
    public function viewAny(User $user): bool
    {
        return true; // Semua user yang login bisa melihat daftar
    }

    public function view(User $user, Project $project): bool
    {
        return true; // Semua user yang login bisa melihat detail
    }

    public function create(User $user): bool
    {
        return in_array($user->role->name, ['admin', 'owner']);
    }

    public function update(User $user, Project $project): bool
    {
        return $project->canBeEditedBy($user);
    }

    public function delete(User $user, Project $project): bool
    {
        return $user->role->name === 'admin';
    }
}
