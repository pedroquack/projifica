<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\Report;
use App\Models\User;

class CommentPolicy
{
    public function user_comment(User $user, Comment $comment){
        return $user->id === $comment->user_id;
    }

    public function destroy(User $user, Comment $comment){
        return $user->id === $comment->user_id;
    }

    public function comment_already_reported(User $user, Comment $comment){
        $report = Report::where('user_id', $user->id)->where('target_id', $comment->id)->get()->count();
        return $report === 0;
    }
}
