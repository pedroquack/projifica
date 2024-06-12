<?php

namespace App\Policies;

use App\Models\Experience;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function user_profile(User $user, User $profile){
        return $user->id === $profile->id;
    }

    public function admin(User $user){
        return $user->role === 'adm';
    }

}
