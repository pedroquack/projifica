<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Education;
use App\Models\Experience;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{

    public function index($name,$id){
        $user = User::find($id);
        $educations = Education::where('user_id', $id)->get();
        $experiences = Experience::where('user_id', $id)->get();
        return view('profile.index',compact('user','educations','experiences'));
    }

    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function educationDestroy($id){
        $education = Education::find($id);
        $education->delete();
        return redirect()->back()->with('message','Educação excluida com sucesso');
    }

    public function experienceDestroy($id){
        $experience = Experience::find($id);
        Gate::authorize('destroy_experience',$experience,User::class);
        $experience->delete();
        return redirect()->back()->with('message','Experiência excluida com sucesso');
    }


}
