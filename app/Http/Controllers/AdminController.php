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
        $projects = Project::all()->count();
        $users = User::all()->count();
        $posts = Post::all()->count();

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

        return view('admin.dashboard', compact('users','projects','posts','userYear','userTotal','postsTotal','postsYear','projectsTotal','projectsYear'));
    }
}
