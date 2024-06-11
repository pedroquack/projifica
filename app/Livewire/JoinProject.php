<?php

namespace App\Livewire;

use App\Mail\Notification;
use App\Models\LinkUserProject;
use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Throwable;

use function Laravel\Prompts\error;

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

        $notification = [
            'subject' => 'Notificação: Alguem se candidatou ao seu projeto',
            'title' => 'Alguem acabou de se candidatar ao seu projeto!',
            'message' => 'O usuário ' . $this->user->name . ' acabou de se candidatar ao seu projeto: ' . $this->project->title,
        ];

        try {
            Mail::to($this->project->user->email)->queue(new Notification($notification));
            return redirect()->route('project.show',$this->project->id)->with('message','Você se candidatou ao projeto com sucesso!');
        } catch(Throwable $error){
            report($error);
            abort(500, 'Erro ao notificar');
        };

    }
}
