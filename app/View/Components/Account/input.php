<?php

namespace App\View\Components\Account;

use Illuminate\View\Component;

class input extends Component
{
    public $name = null;
    public $type = null;
    public $value = null;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct( $name, $type, $value )
    {
        $this->name = $name;
        $this->type = $type;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.account.input');
    }
}
