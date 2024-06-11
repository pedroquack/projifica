<?php

namespace App\Livewire;

use App\Mail\Notification;
use App\Models\Comment as ModelsComment;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Throwable;

class Comment extends Component
{
    public string $body;
    public $post;
    public $user_id;

    protected $rules = [
        'body' => ['required','min:1','max:1000'],
        'post' => ['required',],
        'user_id' => ['required',],
    ];

    public function render()
    {
        return view('livewire.comment');
    }

    public function store(){
        $this->validate();

        $comment = ModelsComment::create([
            'body' => $this->body,
            'user_id' => $this->user_id,
            'post_id' => $this->post->id
        ]);

        $notification = [
            'subject' => 'Notificação: Alguem comentou no seu post',
            'title' => 'Alguem acabou de fazer um comentário na sua postagem!',
            'message' => 'O usuário ' . $comment->user->name . ' comentou na sua postagem: ' . $comment->post->title,
        ];

        try {
            Mail::to($this->post->user->email)->queue(new Notification($notification));
            return redirect()->route('post.show',$this->post->id);
        } catch(Throwable $error){
            report($error);
            abort(500, 'Erro ao notificar');
        };
    }
}
