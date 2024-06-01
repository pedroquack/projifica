<?php

namespace App\Policies;

use App\Models\Education;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class EducationPolicy
{
    public function destroy(User $user, Education $education)
    {
        return $user->id === $education->user_id;
    }
}
