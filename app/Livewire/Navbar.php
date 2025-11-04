<?php

namespace App\Livewire;

use Livewire\Component;

class Navbar extends Component
{
    public function render()
    {
        return view('livewire.navbar');
    }

    public function stock()
    {
        return redirect('/stock');
    }

    public function handover()
    {
        return redirect('/handover');
    }

    public function config()
    {
        return redirect('/config');
    }

    public function logout()
    {
        session()->forget('initial');
        return redirect()->route('login');
    }
}
