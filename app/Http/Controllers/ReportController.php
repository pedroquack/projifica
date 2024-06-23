<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function store(Request $request, string $type ){

        $request->validate([
            'user_id' => ['required'],
            'target_id' => ['required'],
        ]);

        switch($type){
            case "post": $target = Post::find($request->target_id); break;
            case "project": $target = Project::find($request->target_id); break;
            case "user": $target = User::find($request->target_id); break;
            case "comment": $target = Comment::find($request->target_id); break;
            default: abort(500);
        }

        if($target){
            $target->reports()->create([
                'user_id' =>$request->user_id,
                'reason' => $request->reason,
            ]);

            foreach(User::where('role','adm') as $adm){

            }
        }

        return redirect()->back()->with('message','Denúncia enviada!');
    }

}
