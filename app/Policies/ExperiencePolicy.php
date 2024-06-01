<?php

namespace App\Policies;

use App\Models\Experience;
use App\Models\User;

class ExperiencePolicy
{
    public function destroy(User $user, Experience $experience){
        return $user->id === $experience->user_id;
    }
}
