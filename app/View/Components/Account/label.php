<?php

namespace App\View\Components\Account;

use Illuminate\View\Component;

class label extends Component
{
    public $label = null;
    public $name = null;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct( $name, $label )
    {
        $this->name = $name;
        $this->label = $label;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.account.label');
    }
}
