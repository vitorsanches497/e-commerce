<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class Register extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';

    public function register()
    {
        $this->validate([
            'name' => ['required', 'string', 'min:3'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:6'],
        ]);

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password), 
        ]);

        return redirect()->route('login');
    }

    public function render()
    {
        return view('livewire.register')
            ->layout('components.layouts.auth', [
                'title' => 'Cadastro',
            ]);
    }
}
