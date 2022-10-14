<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Modal extends Component
{
    /**
     * id toho co se bude v modalu upravovat.
     *
     * @var string
     */
    public $item_id;

    /**
     * typ toho co se bude v modalu upravovat.
     *
     * @var string
     */
    public $type;


    /**
     * stary obsah.
     *
     * @var string
     */
    public $content;

    /**
     * funkce (uprava/mazani).
     *
     * @var string
     */
    public $function;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id, $type, $content, $function)
    {
        
        $this->item_id = $id;
        $this->type = $type;
        $this->content = $content;
        $this->function = $function;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modal');
    }
}
