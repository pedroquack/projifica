<?php

namespace App\Livewire\Dashboard;

use App\Models\User;
use Livewire\Component;

class Users extends Component
{
    public $search = "";

    public function render()
    {

        return view('livewire.dashboard.users', [
            'users' => User::where('name','like', '%'.$this->search.'%')->orWhere('email','like','%'.$this->search.'%')->get(),
            'search' => $this->search
         ]);
    }
}
