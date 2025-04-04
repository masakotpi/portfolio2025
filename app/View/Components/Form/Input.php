<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component
{
    public $name;
    public $type;
    public $label;

    public function __construct($name, $label = '', $type = 'text')
    {
        $this->name = $name;
        $this->type = $type;
        $this->label = $label;
    }

    public function render()
    {
        return view('components.form.input');
    }
}
