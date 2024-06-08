<?php

namespace App\Http\Controllers;

use App\Models\LinkSkillProject;
use App\Models\Project;
use App\Models\Skill;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::where('user_id','!=',Auth::user()->id)->where('expiration', '>' , Carbon::yesterday() )->paginate(10);
        return view('projects.index', compact('projects'));
    }

    public function user_projects($id){
        $projects = Project::where('user_id',$id)->paginate(10);
        return view('projects.index', compact('projects'));
    }

    public function project_joined($id){
        $projects = Project::whereHas('candidates', function(Builder $query) use ($id){
            $query->where('user_id', $id);
        })->paginate(10);
        return view('projects.index', compact('projects'));
    }

    public function most_popular(){
        $projects = Project::where('user_id','!=',Auth::user()->id)->where('expiration', '>' , Carbon::yesterday() )->withCount('candidates')->orderBy('candidates_count','DESC')->paginate(10);
        return view('projects.index', compact('projects'));
    }

    public function less_popular(){
        $projects = Project::where('user_id','!=',Auth::user()->id)->where('expiration', '>' , Carbon::yesterday() )->withCount('candidates')->orderBy('candidates_count')->paginate(10);
        return view('projects.index', compact('projects'));
    }

    public function search(Request $request){
        $search = $request->search_bar;
        $projects = Project::where('user_id','!=',Auth::user()->id)->where('title' , 'LIKE' , "%{$request->search_bar}%")->orWhereHas('skills', function (Builder $query) use ($search){
            $query->where('name', 'LIKE', "%{$search}%");
        })->where('expiration', '>' , Carbon::yesterday() )->paginate(10);
        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $skills = Skill::all();
        return view('projects.create', compact('skills'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'max:2500', 'min:100'],
            'skills' => ['required'],
            'modality' => ['required'],
            'expiration' => ['required','date','after:today'],
            'slots' => ['required','numeric','min:1','max:100'],
            'user_id' => ['required',],
        ]);

        $project = Project::create([
            'title' => $request->title,
            'description' => $request->description,
            'modality' => $request->modality,
            'expiration' => $request->expiration,
            'slots' => $request->slots,
            'user_id' => $request->user_id,
        ]);

        $skills = $request->input('skills');
        foreach ($skills as $s) {
            LinkSkillProject::create([
                'project_id' => $project->id,
                'skill_id' => $s,
            ]);
        }
        return redirect()->route('project.show',$project->id);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $project = Project::find($id);

        $today = new DateTime();
        $expiration = new DateTime($project->expiration);
        $diff = $today->diff($expiration);
        $diff = $diff->format('%d');
        return view('projects.show',compact('project','diff'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        return view('projects.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //
    }
}
