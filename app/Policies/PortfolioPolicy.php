<?php

namespace App\Policies;

use App\Models\Portfolio;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PortfolioPolicy
{
    public function update(User $user, Portfolio $portfolio): bool
    {
        return $user->id === $portfolio->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Portfolio $portfolio): bool
    {
        return $user->id === $portfolio->user_id;
    }

}
