<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ExperienceController extends Controller
{
    public function destroy($id){
        $experience = Experience::find($id);
        Gate::authorize('destroy',$experience);
        $experience->delete();
        return redirect()->back()->with('message','Experiência excluida com sucesso');
    }
}
