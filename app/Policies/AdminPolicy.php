<?php

namespace App\Policies;

use App\Models\User;

class AdminPolicy
{
    /**
     * Create a new policy instance.
     */
    public function viewDashboard(User $user): bool
    {
        return $user->is_admin; // Sesuaikan dengan kolom admin di database
    }
}
