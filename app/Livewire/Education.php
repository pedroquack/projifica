<?php

namespace App\Livewire;

use App\Models\Education as ModelsEducation;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Education extends Component
{

    public string $school;
    public string $course;
    public int $start_date;
    public int $end_date;

    protected function rules()
    {
        $end_date_validation = "";
        $start_date_validation = "";

        if(isset($this->start_date)){
            $start_date_validation = 'lte:'. $this->end_date;
        }

        if(isset($this->end_date)){
            $end_date_validation = 'gte:' . $this->start_date;
        }

        return [
            'school' => ['required', 'min:3', 'max:96'],
            'course' => ['required', 'min:3', 'max:128'],
            'start_date' => ['required', 'digits:4', 'integer', 'min:1950', 'max:2100', $start_date_validation],
            'end_date' => ['required', 'digits:4', 'integer', 'min:1950', 'max:2100', $end_date_validation],
        ];
    }

    public function render()
    {
        return view('livewire.education');
    }

    public function store()
    {
        $this->validate($this->rules());

        $education = ModelsEducation::create([
            'school' => $this->school,
            'course' => $this->course,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->route('profile.index', $education->user->id);
    }
}
