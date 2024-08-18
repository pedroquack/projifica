<?php

namespace App\Http\Controllers;

use App\Mail\Notification;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Project;
use App\Models\User;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Throwable;

class ReportController extends Controller
{
    public function store(Request $request, string $type ){

        $request->validate([
            'user_id' => ['required'],
            'target_id' => ['required'],
        ]);

        switch($type){
            case "post": $target = Post::find($request->target_id); Gate::authorize('post_already_reported',$target); break;
            case "project": $target = Project::find($request->target_id); Gate::authorize('project_already_reported',$target); break;
            case "user": $target = User::find($request->target_id); Gate::authorize('user_already_reported',$target); break;
            case "comment": $target = Comment::find($request->target_id); Gate::authorize('comment_already_reported',$target);  break;
            default: return abort(403);
        }

        if($target){
            $report = $target->reports()->create([
                'user_id' =>$request->user_id,
            ]);

            $url = route('dashboard/reports');

            $notification = [
                'subject' => 'Notificação: Alguem fez uma denúncia',
                'title' => 'Alguem acabou de fazer uma denúncia!',
                'message' => 'O usuário ' . $report->user->name . ' fez uma denúncia! Que tal conferir?',
                'url' => $url,
            ];

            foreach(User::where('role','adm')->get() as $adm){
                try {
                    Mail::to($adm->email)->queue(new Notification($notification));
                } catch(Throwable $error){
                    report($error);
                    abort(500, 'Erro ao notificar');
                };
            }
        }
        return redirect()->back()->with('message','Denúncia enviada!');
    }

}
