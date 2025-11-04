<?php

namespace App\Livewire;

use App\Models\Item;
use Livewire\Attributes\Title;
use Livewire\Component;

class Dashboard extends Component
{
    #[Title('DFA IT Services')]

    public $items;


    public function render()
    {
        $this->items = Item::all();
        return view('livewire.dashboard');
    }
}
