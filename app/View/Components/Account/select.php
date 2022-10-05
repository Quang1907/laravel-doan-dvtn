<?php

namespace App\View\Components\Account;

use Illuminate\View\Component;

class select extends Component
{
    public $name = null;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct( $name )
    {
        $this->name = $name;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.account.select');
    }
}
