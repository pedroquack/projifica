<?php

namespace App\Http\Controllers;

use App\Models\LinkSkillPortfolio;
use App\Models\Portfolio;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    public function index($id)
    {
        $user = User::find($id);

        return view('portfolio.index', compact('user'));
    }

    public function create()
    {
        $skills = Skill::all();
        return view('portfolio.create', compact('skills'));
    }

    public function store(Request $request)
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
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'max:500', 'min:150'],
            'url' => ['nullable','url'],
            'skills' => ['required'],
            'image' => [$image_validation, 'mimes:png,jpg,jpeg,webp'],
            'user_id' => ['required'],
        ]);

        $portfolio = new Portfolio();

        if(session()->get('temp_image')){
            $temp_img = session()->get('temp_image');
            $extension = pathinfo($temp_img, PATHINFO_EXTENSION);
            $filename = $portfolio->user_id."_".time().".". $extension;
            $path = 'images/portfolio/';
            Storage::move("public/" . $temp_img, "public/".$path.$filename);
            $portfolio->image = "storage/" . $path . $filename;
            session()->forget(['temp_image','file_name']);
        }

        $portfolio->name = $request->name;
        $portfolio->description = $request->description;
        $portfolio->url = $request->url;
        $portfolio->user_id = $request->user_id;
        $portfolio->save();

        $skills = $request->input('skills');
        foreach ($skills as $s) {
            LinkSkillPortfolio::create([
                'portfolio_id' => $portfolio->id,
                'skill_id' => $s,
            ]);
        }
        return redirect()->route('portfolio.index', $portfolio->user->id);
    }

    public function edit(Request $request, $id)
    {
        $portfolio = Portfolio::find($id);
        Gate::authorize('update',$portfolio);
        $skills = Skill::all();
        $selectedSkills = $portfolio->skills->pluck('id')->toArray();
        return view('portfolio.edit', compact('portfolio', 'skills', 'selectedSkills'));
    }

    public function update(Request $request, $id)
    {

        $portfolio = Portfolio::find($id);
        Gate::authorize('update',$portfolio);

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
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'max:500', 'min:150'],
            'url' => ['nullable','url'],
            'skills' => ['required'],
            'image' => [$image_validation,'mimes:png,jpg,jpeg,webp'],
            'user_id' => ['required'],
        ]);

        if(session()->get('temp_image')){
            $temp_img = session()->get('temp_image');
            $extension = pathinfo($temp_img, PATHINFO_EXTENSION);
            $filename = $portfolio->user_id."_".time().".". $extension;
            $path = 'images/portfolio/';
            Storage::move("public/" . $temp_img, "public/".$path.$filename);
            if(isset($post->image)){
                $old_path = str_replace('storage/', 'public/', $portfolio->image);
                Storage::delete($old_path);
            }
            $portfolio->image = "storage/" . $path . $filename;
            session()->forget(['temp_image','file_name']);
        }

        $portfolio->name = $request->name;
        $portfolio->description = $request->description;
        $portfolio->url = $request->url;
        $portfolio->user_id = $request->user_id;
        $portfolio->save();

        $skills = $request->input('skills');
        $selectedSkills = $portfolio->skills->pluck('id')->toArray();
        foreach ($skills as $s) {
            if (!in_array($s, $selectedSkills)) {
                LinkSkillPortfolio::create([
                    'portfolio_id' => $portfolio->id,
                    'skill_id' => $s,
                ]);
            } else {
                foreach ($portfolio->skills as $ps) {
                    if (!in_array($ps->id, $skills)) {
                        $linkskill = LinkSkillPortfolio::where('skill_id', $ps->id)->where('portfolio_id', $portfolio->id);
                        $linkskill->delete();
                    }
                }
            }
        }
        return redirect()->route('portfolio.index', $portfolio->user->id);
    }

    public function destroy($id){
        $portfolio = Portfolio::find($id);
        Gate::authorize('update',$portfolio);
        $portfolio->delete();
        return redirect()->back()->with('message','Item do portfólio excluido com sucesso!');
    }
}
