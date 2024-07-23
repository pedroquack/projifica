<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{

    public function index()
    {
        return view('admin.skills');
    }

    public function destroy(string $id)
    {
        $skill = Skill::find($id);
        if(!isset($skill)){
            http_response_code(404);
            return abort(404);
        }
        $skill->delete();
        return redirect()->back()->with('message','Habilidade excluída com sucesso!');
    }
}
