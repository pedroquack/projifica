<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;

class CommentPolicy
{
    public function user_comment(User $user, Comment $comment){
        return $user->id === $comment->user_id;
    }

    public function destroy(User $user, Comment $comment){
        return $user->id === $comment->user_id;
    }
}
