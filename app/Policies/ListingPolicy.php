<?php

namespace App\Policies;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ListingPolicy
{

    /**
     * prevent going to a link of a suspended user // ?User $user can be null so that
     * users that are not logged in can see the detailed listing, policies always expect a User
     */
    public function view(?User $user, Listing $listing): bool
    {
        return $listing->user->role !== 'suspended' && $listing->approved;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role !== 'suspended';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Listing $listing): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Listing $listing): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Listing $listing): bool
    {
        return false;
    }


    public function modify(User $user, Listing $listing): bool
    {
        return $user->role !== 'suspended' && $user->id === $listing->user_id;
    }
}
