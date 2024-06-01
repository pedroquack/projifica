<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function edit($id){
        $user = User::find($id);
        Gate::authorize('user_profile',$user);
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request, $id){

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required','max:1000','min:150'],
            'phone' => ['required',"unique:users,phone,{$id},id"]
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->description = $request->description;
        $user->phone = $request->phone;
        $user->save();

        return redirect()->route('home');
    }
}
