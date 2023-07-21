<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use LivewireUI\Modal\ModalComponent;

class DestroyComment extends ModalComponent
{
    public Comment $comment;

    public function render()
    {
        return view('livewire.destroy-comment');
    }
}
