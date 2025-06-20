<?php

namespace App\Policies;

use App\Models\Kamar;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class KamarPolicies
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // Allow all users to view any Kamar tersedia
        if ($user->role === 'admin' || $user->role === 'user') {
            return true;
        }

        // If the user is not an admin or user, deny access
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Kamar $kamar): bool
    {
        // Allow all users to view a specific Kamar
        if ($user->role === 'admin' || $user->role === 'user') {
            return true;
        }

        // If the user is not an admin or user, deny access
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Only allow admins to create Kamar
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Kamar $kamar): bool
    {
        // Only allow admins to update Kamar
        return $user->role === 'admin';

    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Kamar $kamar): bool
    {
        // Only allow admins to delete Kamar
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Kamar $kamar): bool
    {
        // Only allow admins to restore Kamar
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Kamar $kamar): bool
    {
        // Only allow admins to permanently delete Kamar
        return $user->role === 'admin';
    }
}
