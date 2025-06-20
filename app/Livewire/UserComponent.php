<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class UserComponent extends Component
{
    use WithPagination, WithoutUrlPagination;

    protected $paginationTheme = 'bootstrap';
    public $id, $name, $alamat, $telepon, $email, $password, $jenis, $cari;

    public function render()
    {
        $layout['title'] = "Kelola User";
        if ($this->cari != "") {
            $data['user'] = User::where('name', 'like', '%' . $this->cari . '%')
                ->orWhere('email', 'like', '%' . $this->cari . '%')
                ->paginate(10);
        } else {
            $data['user'] = User::paginate(10);
        }

        return view('livewire.user-component', $data);
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'name.required' => 'Nama Tidak Boleh Kosong!',
            'email.required' => 'Email Tidak Boleh Kosong!',
            'email.email' => 'Format Email Salah!',
            'password.required' => 'Password Tidak Boleh Kosong!'
        ]);

        if (User::where('email', $this->email)->exists()) {
            session()->flash('error', 'Email sudah terdaftar!');
            return;
        }

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'jenis' => 'admin'
        ]);
        session()->flash('success', 'Berhasil Simpan!');
        $this->reset();
    }

    public function edit($id)
    {
        $user = User::find($id);
        $this->name = $user->name;
        $this->email = $user->email;
        $this->id = $user->id;
    }

    public function update()
    {
        $user = User::find($this->id);
        if ($this->password == "") {
            $user->update([
                'name' => $this->name,
                'email' => $this->email
            ]);
        } else {
            $user->update([
                'name' => $this->name,
                'email' => $this->email,
                'password' => $this->password
            ]);
        }
        session()->flash('success', 'Berhasil Ubah!');
        $this->reset();
    }

    public function confirm($id)
    {
        $this->id = $id;
    }

    public function destroy()
    {
        $user = User::find($this->id);
        $user->delete();
        session()->flash('success', 'Berhasil Hapus!');
        $this->reset();
    }
}
