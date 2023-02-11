<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Group;
use Illuminate\Auth\Access\HandlesAuthorization;

class GroupPolicy
{
    use HandlesAuthorization;

    
    public function edit(User $user, Group $group) {
        return $user->admin || $group->user_id == auth()->id();
    }
    
    public function delete(User $user, Group $group) {
        return $user->admin || $group->user_id == auth()->id();
    }
}
