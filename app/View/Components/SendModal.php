<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SendModal extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $contactId;
    public function __construct($contactId)
    {
        $this->contactId = $contactId;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.send-modal');
    }
}
