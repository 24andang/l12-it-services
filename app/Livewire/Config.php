<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Config extends Component
{
    #[Title('Config')]

    public $users;
    public $initial;

    #[Validate('required')]
    public $newPassword;

    public function render()
    {
        $this->initial = session('initial');
        $this->users = User::where('initial', $this->initial)->first();
        return view('livewire.config');
    }

    public function updatePassword()
    {
        $this->initial = session('initial');
        $user = User::where('initial', $this->initial)->first();

        $user->update(
            ['password' => Hash::make($this->newPassword)]
        );

        session()->flash('done', 'Password update.');
    }
}
