<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Nav extends Component
{
    public $taverns = [];
    /**
     * Create a new component instance.
     */
    public function __construct($taverns)
    {
        $this->taverns = $taverns;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.nav', [
            'taverns' => $this->taverns
        ]);
    }
}
