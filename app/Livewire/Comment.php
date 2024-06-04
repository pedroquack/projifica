<?php

namespace App\Livewire;

use App\Models\Comment as ModelsComment;
use Livewire\Component;

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

        ModelsComment::create([
            'body' => $this->body,
            'user_id' => $this->user_id,
            'post_id' => $this->post->id
        ]);

        $this->dispatch('commentAdded');
    }
}
