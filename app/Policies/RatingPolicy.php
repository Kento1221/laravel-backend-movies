<?php

namespace App\Policies;

use App\Models\Policy;
use App\Models\Rating;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class RatingPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create the model.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //Always can create for now
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Rating $rating
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Rating $rating)
    {
        return $user->id == $rating->user_id
            ? Response::allow()
            : Response::deny('Cannot update. You do not own this rating.');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Rating $rating
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Rating $rating)
    {
        return $user->isAdmin() || $user->id == $rating->user_id
            ? Response::allow()
            : Response::deny('Cannot delete. You do not own this rating.');
    }
}
