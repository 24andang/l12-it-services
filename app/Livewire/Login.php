<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

use function Laravel\Prompts\error;

class Login extends Component
{
    #[Validate('required')]
    public $user;

    #[Validate('required')]
    public $password;

    #[Title('Login')]

    public function render()
    {
        return view('livewire.login');
    }

    public function login()
    {
        $this->validate();

        $user = User::where('initial', $this->user)->first();

        if ($user && Hash::check($this->password, $user['password'])) {
            session(['initial' => $user['initial']]);
            return redirect('/dashboard');
        } else {
            $this->addError('auth', 'Wrong auth.');
        }
    }
}
