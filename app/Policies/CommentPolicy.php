<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Comment;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    public function edit(User $user, Comment $comment)
    {
        return $user->admin || $comment->user_id == auth()->id();
    }

    public function destroy(User $user, Comment $comment)
    {
        return $user->admin || $comment->user_id == auth()->id();
    }
}
