<?php

namespace App\Livewire;

use App\Models\Experience as ModelsExperience;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Experience extends Component
{
    public string $company;
    public string $role;
    public int $start_date;
    public int $end_date;
    public string $description;
    public $actual = false;

    protected function rules()
    {
        $end_date_validation = "";
        $start_date_validation = "";
        $end_date_rules = "";

        if(isset($this->start_date) && isset($this->end_date)){
            $start_date_validation = 'lte:'. $this->end_date;
        }

        return [
            'company' => ['required', 'min:8', 'max:96'],
            'role' => ['required', 'min:8', 'max:128'],
            'description' => ['required', 'min:32', 'max:500'],
            'start_date' => ['required', 'digits:4', 'integer', 'min:1950', 'max:2100',$start_date_validation],
            'end_date' => ['nullable','digits:4', 'integer', 'min:1950', 'max:2100',$end_date_validation],
        ];
    }

    public function render()
    {
        return view('livewire.experience');
    }

    public function store()
    {
        $this->validate();
        if(!isset($this->end_date) || $this->actual == true){
            $this->end_date = 0;
        }
        $experience = ModelsExperience::create([
            'company' => $this->company,
            'role' => $this->role,
            'description' => $this->description,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->route('profile.index',$experience->user->id);
    }
}
