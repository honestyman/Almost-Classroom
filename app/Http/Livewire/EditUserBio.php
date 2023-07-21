<?php

namespace App\Http\Livewire;

use App\Models\User;
use LivewireUI\Modal\ModalComponent;

class EditUserBio extends ModalComponent
{
    public User $user;

    public function render()
    {
        return view('livewire.edit-user-bio');
    }
}
