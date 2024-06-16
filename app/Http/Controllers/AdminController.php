<?php

namespace App\Http\Controllers;

use App\Models\LinkUserProject;
use App\Models\Post;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard(){
        $users = User::all();
        $projects = Project::all();
        $posts = Post::all();

        $dataUsers = User::select([
            DB::raw('YEAR(created_at) as year'),
            DB::raw('COUNT(*) as total'),
        ])->groupBy('year')->orderBy('year')->get();

        $dataPosts = Post::select([
            DB::raw('YEAR(created_at) as year'),
            DB::raw('COUNT(*) as total'),
        ])->groupBy('year')->orderBy('year')->get();

        $dataProjects = Project::select([
            DB::raw('YEAR(created_at) as year'),
            DB::raw('COUNT(*) as total'),
        ])->groupBy('year')->orderBy('year')->get();

        foreach($dataUsers as $u){
            $year[] = $u->year;
            $total[] = $u->total;
        }

        $userYear = implode(',', $year);
        $userTotal = implode(',',$total);

        foreach($dataPosts as $p){
            $totalPost[] = $p->total;
            $yearPost[] = $p->year;
        }

        $postsTotal = implode(',', $totalPost);
        $postsYear = implode(',', $yearPost);

        foreach($dataProjects as $p){
            $totalProject[] = $p->total;
            $yearProject[] = $p->year;
        }

        $projectsTotal = implode(',', $totalProject);
        $projectsYear = implode(',', $yearProject);

        return view('admin.chart', compact('users','projects','posts','userYear','userTotal','postsYear','postsTotal','projectsYear','projectsTotal'));
    }

    public function users(){
        $users = User::all()->count();
        return view('admin.users',compact('users'));
    }

    public function user_destroy($id){
        $user = User::find($id);
        $user->delete();
        return redirect()->back()->with('message','Usuário excluído com sucesso!');
    }

    public function projects(){
        $projects = Project::all()->count();
        return view('admin.projects',compact('projects'));
    }

    public function project_destroy($id){
        $project = Project::find($id);
        $project->delete();
        return redirect()->back()->with('message','Projeto excluído com sucesso!');
    }

    public function posts(){
        $posts = Post::all()->count();
        return view('admin.posts',compact('posts'));
    }

    public function post_destroy($id){
        $post = Post::find($id);
        $post->delete();
        return redirect()->back()->with('message','Postagem excluída com sucesso!');
    }
}
