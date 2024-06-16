<?php

namespace App\Livewire\Dashboard;

use App\Models\Post;
use Livewire\Component;

class Posts extends Component
{
    public $search = "";

    public function render()
    {
        return view('livewire.dashboard.posts', [
            'posts' => Post::where('title','like', '%'.$this->search.'%')->orWhereHas('user', function($query){
                $query->where('name','like','%'.$this->search.'%');
            })->get(),
         ]);
    }
}
