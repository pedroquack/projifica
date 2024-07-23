<?php

namespace App\Livewire\Dashboard;

use App\Models\Skill;
use Livewire\Component;

class Skills extends Component
{
    public $search = "";

    public function render()
    {
        return view('livewire.dashboard.skills', [
            'skills' => Skill::where('name','like', '%'.$this->search.'%')->get(),
        ]);
    }
}
