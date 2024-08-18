<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function index(){
        $users = User::paginate(10);
        return view('users.index', compact('users'));
    }

    public function more_posts(){
        $users = User::withCount('posts')->orderBy('posts_count', 'DESC')->paginate(10);
        return view('users.index', compact('users'));
    }

    public function bigger_portfolio(){
        $users = User::withCount('portfolios')->orderBy('portfolios_count', 'DESC')->paginate(10);
        return view('users.index', compact('users'));
    }

    public function edit($id){
        $user = User::find($id);
        Gate::authorize('user_profile',$user);
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request, $id){

        $user = User::find($id);
        Gate::authorize('user_profile',$user);

        $request->validate([
            'name' => ['required', 'string', 'min:3','max:255'],
            'description' => ['required','max:1000','min:96'],
            'phone' => ['required',"unique:users,phone,{$id},id",'size:15']
        ]);

        $user->name = $request->name;
        $user->description = $request->description;
        $user->phone = $request->phone;
        $user->save();

        return redirect()->route('profile.index',$user->id);
    }
}
