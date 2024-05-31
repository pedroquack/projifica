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

    protected $rules = [
        'school' => ['required', 'min:8', 'max:96'],
        'course' => ['required', 'min:8', 'max:128'],
        'start_date' => ['required', 'digits:4', 'integer', 'min:1950', 'max:2050'],
        'end_date' => ['required', 'digits:4', 'integer', 'min:1950', 'max:2050'],
    ];

    public function render()
    {
        return view('livewire.education');
    }

    public function store()
    {
        $this->validate();

        $education = ModelsEducation::create([
            'school' => $this->school,
            'course' => $this->course,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->route('profile.index', [$education->user->name, $education->user->id]);
    }
}
