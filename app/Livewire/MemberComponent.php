<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class MemberComponent extends Component
{
    use WithPagination, WithoutUrlPagination;

    protected $paginationTheme = 'bootstrap';
    public $id, $name, $alamat, $telepon, $email, $password, $jenis, $cari;

    public function render()
    {
        if ($this->cari != "") {
            $data['member'] = User::where('name', 'like', '%' . $this->cari . '%')->paginate(10);
        } else {
            $data['member'] = User::where('jenis', 'member')->paginate(10);
        }
        $data['title'] = 'Kelola Member';
        return view('livewire.member-component', $data);
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'telepon' => 'required',
            'email' => 'required',
            'alamat' => 'required'
        ], [
            'name.required' => 'Nama Lengkap Tidak Boleh Kosong!',
            'telepon.required' => 'Telepon Tidak Boleh Kosong!',
            'email.required' => 'Email Tidak Boleh Kosong!',
            'alamat.required' => 'Alamat Tidak Boleh Kosong!'
        ]);

        if (User::where('email', $this->email)->exists()) {
            session()->flash('error', 'Email sudah terdaftar!');
            return;
        }

        User::create([
            'name' => $this->name,
            'alamat' => $this->alamat,
            'telepon' => $this->telepon,
            'email' => $this->email,
            'jenis' => 'member'
        ]);
        session()->flash('success', 'Berhasil Simpan!');
        return redirect()->route('member');
    }

    public function edit($id)
    {
        $member = User::find($id);
        $this->id = $member->id;
        $this->name = $member->name;
        $this->alamat = $member->alamat;
        $this->telepon = $member->telepon;
        $this->email = $member->email;
    }

    public function update()
    {
        $member = User::find($this->id);
        $member->update([
            'nama' => $this->name,
            'alamat' => $this->alamat,
            'telepon' => $this->telepon,
            'email' => $this->email,
            'jenis' => 'member'
        ]);
        session()->flash('success', 'Berhasil Ubah!');
        return redirect()->route('member');
    }

    public function confirm($id)
    {
        $this->id = $id;
    }

    public function destroy()
    {
        $member = User::find($this->id);
        $member->delete();
        session()->flash('success', 'Berhasil Hapus!');
        return redirect()->route('member');
    }
}
