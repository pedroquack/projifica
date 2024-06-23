<?php

namespace App\Livewire\Dashboard;

use App\Models\Report;
use Livewire\Component;

class Reports extends Component
{

    public function render()
    {
        return view('livewire.dashboard.reports', [
            'reports' => Report::all()
         ]);
    }
}
