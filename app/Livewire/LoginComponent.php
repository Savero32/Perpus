<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LoginComponent extends Component
{
    public $email, $password;

    protected $layout = 'components.layouts.login';

    public function render()
    {
        return view('livewire.login-component')->layout('components.layouts.login');
    }

    public function getLayout()
    {
        return $this->layout;
    }

    public function proses()
    {
        $credential = $this->validate([
            'email' => 'required',
            'password' => 'required'
        ], [
            'email.required' => 'Email Tidak Boleh Kosong!',
            'password.required' => 'Password Tidak Boleh Kosong!'
        ]);

        if (Auth::attempt($credential)) {
            session()->regenerate();
            return redirect()->route('home');
        }
        session()->flash('error', 'Autentikasi Gagal!');
    }

    public function keluar()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->route('login');
    }
}
