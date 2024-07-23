<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\Report;
use App\Models\User;

class PostPolicy
{
    public function user_post(User $user, Post $post){
        return $user->id === $post->user_id;
    }

    public function update(User $user, Post $post){
        return $user->id === $post->user_id;
    }

    public function destroy(User $user, Post $post){
        return $user->id === $post->user_id;
    }

    public function post_already_reported(User $user, Post $post){
        $report = Report::where('user_id', $user->id)->where('target_id', $post->id)->get()->count();
        return $report === 0;
    }
}
