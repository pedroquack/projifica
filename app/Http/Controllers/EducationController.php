<?php

namespace App\Http\Controllers;

use App\Models\Education;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class EducationController extends Controller
{
    public function destroy($id){
        $education = Education::find($id);
        Gate::authorize('destroy',$education);
        $education->delete();
        return redirect()->back()->with('message','Educação excluida com sucesso');
    }
}
