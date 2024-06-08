<?php

namespace App\Livewire;

use App\Models\LinkUserProject;
use App\Models\Project;
use App\Models\User;
use Livewire\Component;

class JoinProject extends Component
{
    public User $user;
    public $proposal;
    public Project $project;

    protected $rules = [
        'proposal' => ['nullable','min:24','max:500'],
        'user' => ['required'],
        'project' => ['required'],
    ];

    public function render()
    {
        return view('livewire.join-project');
    }

    public function store(){
        $this->validate();

        $candidate = new LinkUserProject();
        $candidate->user_id = $this->user->id;
        $candidate->project_id = $this->project->id;
        $this->proposal ? $candidate->proposal = $this->proposal : $candidate->proposal = "Sem proposta";
        $candidate->save();
        return redirect()->route('project.show',$this->project->id)->with('message','Você se candidatou ao projeto com sucesso!');
    }
}
