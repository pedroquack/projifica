<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        if($request->hasFile('image')){
            $temp_img = $request->file('image');
            $path = $temp_img->store('temp','public');
            $file_name = $request->file('image')->getClientOriginalName();
            session(['temp_image' => $path,'file_name' => $file_name]);
        }

        if(session()->has('temp_image')){
            $image_validation = 'nullable';
        }else{
            $image_validation = 'required';
        }

        $request->validate([
            'name' => ['required', 'string','min:3', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', Rules\Password::defaults()],
            'description' => ['required','max:1000','min:96'],
            'image' => [$image_validation,'mimes:png,jpg,jpeg,webp'],
            'phone' => ['unique:users','required','size:15']
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->description = $request->description;
        $user->phone = $request->phone;
        $user->save();

        if(session()->get('temp_image')){
            $temp_img = session()->get('temp_image');
            $extension = pathinfo($temp_img, PATHINFO_EXTENSION);
            $filename = $user->id."_".time().".". $extension;
            $path = 'images/users/';
            Storage::move("public/" . $temp_img, "public/".$path.$filename);
            $user->image = "storage/" . $path . $filename;
            session()->forget(['temp_image','file_name']);
            $user->save();
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('home', absolute: false));
    }
}
