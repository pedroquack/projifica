<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
        $file = $this->image->storeAs('images/users', $user->id."_".time().'.'.$extension, 'public');

        $old_path = str_replace('storage/', 'public/', $user->image);
        Storage::delete($old_path);

        $user->image = "storage/".$file;

        $user->save();

        return redirect()->route('profile.index', $user->id)->with('message','Foto de perfil atualizada com sucesso');
    }
}
