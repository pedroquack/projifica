<?php

namespace App\Policies;

use App\Models\Experience;
use App\Models\Report;
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

    public function user_already_reported(User $user, User $target_user){
        $report = Report::where('user_id', $user->id)->where('target_id', $target_user->id)->get()->count();
        return $report === 0;
    }

}
