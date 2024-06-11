<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;

class ProjectPolicy
{
    public function join(User $user, Project $project){
        if($user->id === $project->user->id){
            return false;
        }else{
            foreach($project->candidates as $c){
                if($c->user->id === $user->id){
                    return false;
                }
            };
            return true;
        }
    }

    public function read_proposals(User $user, Project $project){
        return $user->id === $project->user->id;
    }

    public function update(User $user, Project $project){
        return $user->id === $project->user->id;
    }
    public function destroy(User $user, Project $project){
        return $user->id === $project->user->id;
    }
}
