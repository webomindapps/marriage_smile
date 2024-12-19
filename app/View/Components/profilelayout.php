<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class Profilelayout extends Component
{
    public $customer;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->customer = Auth::guard('customer')->user();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
    
        $customer = $this->customer;
        return view('components.profilelayout', compact('customer'));
    }
}
