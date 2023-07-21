<?php

namespace App\Http\Livewire;

use App\Models\Post;
use LivewireUI\Modal\ModalComponent;

class EditPost extends ModalComponent
{
    public Post $post;
    public $showDiv = false;

    public function render()
    {
        $this->showDiv = $this->post->deadline ? true : false;
        return view('livewire.edit-post');
    }

    public function deadline()
    {
        $this->showDiv = !$this->showDiv;
    }
}
