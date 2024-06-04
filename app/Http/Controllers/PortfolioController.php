<?php

namespace App\Http\Controllers;

use App\Models\LinkSkillPortfolio;
use App\Models\Portfolio;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PortfolioController extends Controller
{
    public function index($name, $id)
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

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'max:500', 'min:150'],
            'url' => ['nullable','url'],
            'skills' => ['required'],
            'image' => ['required', 'mimes:png,jpg,jpeg,webp'],
            'user_id' => ['required'],
        ]);

        if ($request->has('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $path = 'images/portfolio/';
            $file->move($path, $filename);
        }

        $portfolio = Portfolio::create([
            'name' => $request->name,
            'description' => $request->description,
            'url' => $request->url,
            'image' => $path . $filename,
            'user_id' => $request->user_id,
        ]);

        $skills = $request->input('skills');
        foreach ($skills as $s) {
            LinkSkillPortfolio::create([
                'portfolio_id' => $portfolio->id,
                'skill_id' => $s,
            ]);
        }
        return redirect()->route('portfolio.index', [$portfolio->user->name, $portfolio->user->id]);
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

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'max:500', 'min:150'],
            'url' => ['nullable','url'],
            'skills' => ['required'],
            'image' => ['mimes:png,jpg,jpeg,webp'],
            'user_id' => ['required'],
        ]);

        if ($request->has('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $path = 'images/portfolio/';
            $file->move($path, $filename);
            $portfolio->image = $path . $filename;
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
        return redirect()->route('portfolio.index', [$portfolio->user->name, $portfolio->user->id]);
    }

    public function destroy($id){
        $portfolio = Portfolio::find($id);
        Gate::authorize('update',$portfolio);
        $portfolio->delete();
        return redirect()->back()->with('message','Item do portfólio excluido com sucesso!');
    }
}
