<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProfileImageUpdate extends Component
{

    use WithFileUploads;

    public $image;
    public $user_id;

    protected $rules = [
        'image' => ['required', 'mimes:png,jpg,jpeg,webp'],
    ];

    public function render()
    {
        return view('livewire.profile-image-update');
    }

    public function update()
    {
        $this->validate();

        $user = User::find($this->user_id);
        $extension = $this->image->getClientOriginalExtension();
        $file = $this->image->storePubliclyAs('images/users', time().'.'.$extension,'real_public');

        $user->image = $file;

        $user->save();

        return redirect()->route('profile.index', [$user->name, $user->id])->with('message','Foto de perfil atualizada com sucesso');
    }
}
