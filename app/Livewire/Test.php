<?php

namespace App\Livewire;

use Livewire\Attributes\Url;
use Livewire\Component;

class Test extends Component
{
    #[Url]
    public $search = '';

    public function render()
    {
        return view('livewire.test');
    }
}
