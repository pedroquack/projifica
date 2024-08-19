<?php

namespace App\Livewire;

use App\Mail\Notification;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Throwable;

class Report extends Component
{
    public String $type;
    public $target_id;
    public $user_id;
    public $reason;

    protected $rules = [
        'user_id' => ['required'],
        'target_id' => ['required'],
        'reason' => ['required', 'min:8', 'max:256'],
    ];

    public function render()
    {
        return view('livewire.report');
    }

    public function store()
    {
        $this->validate();
        switch ($this->type) {
            case "post":
                $target = Post::find($this->target_id);
                $this->authorize('post_already_reported', $target);
                $route = redirect()->route('post.show',$target->id)->with('message', 'Denúncia enviada!');
                break;
            case "project":
                $target = Project::find($this->target_id);
                $this->authorize('project_already_reported', $target);
                $route = redirect()->route('project.show',$target->id)->with('message', 'Denúncia enviada!');
                break;
            case "user":
                $target = User::find($this->target_id);
                $this->authorize('user_already_reported', $target);
                $route = redirect()->route('user.index',$target->id)->with('message', 'Denúncia enviada!');
                break;
            case "comment":
                $target = Comment::find($this->target_id);
                $this->authorize('comment_already_reported', $target);
                $route = redirect()->route('post.show',$target->post->id)->with('message', 'Denúncia enviada!');
                break;
            default:
                return abort(403);
        }

        if ($target) {
            $report = $target->reports()->create([
                'user_id' => $this->user_id,
                'reason' => $this->reason,
            ]);

            $url = route('admin.reports');

            $notification = [
                'subject' => 'Notificação: Alguem fez uma denúncia',
                'title' => 'Alguem acabou de fazer uma denúncia!',
                'message' => 'O usuário ' . $report->user->name . ' fez uma denúncia! Que tal conferir?',
                'url' => $url,
            ];

            foreach (User::where('role', 'adm')->get() as $adm) {
                try {
                    Mail::to($adm->email)->queue(new Notification($notification));
                } catch (Throwable $error) {
                    report($error);
                    abort(500, 'Erro ao notificar');
                };
            }
        }
        return $route;
    }
}
