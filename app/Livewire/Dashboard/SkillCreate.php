<?php

namespace App\Livewire\Dashboard;

use App\Models\Skill;
use Livewire\Component;

class SkillCreate extends Component
{

    public $name;

    protected $rules = [
        'name' => 'required|max:96|unique:skills',
    ];

    public function store(){
        $this->validate();
        Skill::create([
            'name' => $this->name,
        ]);
        return redirect()->route('admin.skills')->with('message','Habilidade adicionada com sucesso!');
    }

    public function render()
    {
        return view('livewire.dashboard.skill-create');
    }
}
