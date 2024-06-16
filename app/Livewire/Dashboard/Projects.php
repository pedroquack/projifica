<?php

namespace App\Livewire\Dashboard;

use App\Models\Project;
use Livewire\Component;

class Projects extends Component
{
    public $search = "";

    public function render()
    {
        return view('livewire.dashboard.projects', [
            'projects' => Project::where('title','like', '%'.$this->search.'%')->orWhereHas('user', function($query){
                $query->where('name','like','%'.$this->search.'%');
            })->get(),
         ]);
    }
}
