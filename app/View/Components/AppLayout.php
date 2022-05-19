<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AppLayout extends Component
{
    public $showCategories;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($showCategories = false)
    {
        $this->showCategories = $showCategories;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('layouts.app');
    }
}
