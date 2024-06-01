<?php

namespace App\Livewire;

use Livewire\Component;

class ExperienceUpdate extends Component
{
    public $e;
    public string $company;
    public string $role;
    public int $start_date;
    public int $end_date;
    public string $description;

    protected $rules = [
        'company' => ['required', 'min:8', 'max:96'],
        'role' => ['required', 'min:8', 'max:128'],
        'description' => ['required', 'min:32', 'max:500'],
        'start_date' => ['required', 'digits:4', 'integer', 'min:1950', 'max:2050'],
        'end_date' => ['required', 'digits:4', 'integer', 'min:1950', 'max:2050'],
    ];

    public function mount()
    {
        $this->company = $this->e->company;
        $this->role = $this->e->role;
        $this->description = $this->e->description;
        $this->start_date = $this->e->start_date;
        $this->end_date = $this->e->end_date;
    }

    public function render()
    {
        return view('livewire.experience-update');
    }

    public function update(){
        $this->validate();

        $this->e->update([
            'company' => $this->company,
            'role' => $this->role,
            'description' => $this->description,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
        ]);

        return redirect()->route('profile.index', [$this->e->user->name, $this->e->user->id])->with('message','Experiência atualizada com sucesso');
    }
}
