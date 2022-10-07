<?php

namespace App\View\Components\account;

use Illuminate\View\Component;

class divInput extends Component
{
    public $type = null;
    public $name = null;
    public $label = null;
    public $value = null;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct( $name, $type, $label, $value )
    {
        $this->name = $name;
        $this->type = $type;
        $this->label = $label;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.account.div-input');
    }
}
