<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{
    public function destroy($id)
    {
        $comment = Comment::find($id);
        Gate::authorize('destroy',$comment);
        $comment->delete();
        return redirect()->back()->with('message','Comentário excluido com sucesso!');
    }
}
