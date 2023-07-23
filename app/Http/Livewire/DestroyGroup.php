<?php

namespace App\Http\Livewire;

use App\Models\Group;
use LivewireUI\Modal\ModalComponent;

class DestroyGroup extends ModalComponent
{
    public Group $group;

    public function render()
    {
        return view('livewire.destroy-group');
    }
}
