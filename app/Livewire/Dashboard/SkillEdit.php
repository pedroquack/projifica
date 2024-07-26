<?php

namespace App\Livewire\Dashboard;

use App\Models\Skill;
use Livewire\Component;

class SkillEdit extends Component
{
    public Skill $skill;
    public $name;

    protected $rules = [
        'name' => 'required|max:96|unique:skills',
    ];

    public function update(){
        $this->validate();
        $this->skill->name = $this->name;
        $this->skill->save();
        return redirect()->route('admin.skills')->with('message','Habilidade editada com sucesso!');
    }

    public function render()
    {
        $this->name = $this->skill->name;
        return view('livewire.dashboard.skill-edit');
    }
}
