<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\Report;
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
    public function project_already_reported(User $user, Project $project){
        $report = Report::where('user_id', $user->id)->where('target_id', $project->id)->get();
        return isset($report);
    }
}
