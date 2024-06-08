<?php

namespace App\Livewire;

use App\Models\Project;
use Livewire\Component;

class Candidates extends Component
{
    public Project $project;

    public function render()
    {
        return view('livewire.candidates');
    }
}
