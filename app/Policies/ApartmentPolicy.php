<?php

namespace App\Policies;

use App\Models\Apartment;
use App\Models\User;

class ApartmentPolicy
{
    /**
     * Determine whether the user can update the apartment.
     */
    public function update(User $user, Apartment $apartment): bool
    {
        return $user->id === $apartment->owner_id;
    }
}
