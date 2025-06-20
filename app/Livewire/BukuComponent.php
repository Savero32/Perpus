<?php

namespace App\Livewire;

use App\Models\Buku;
use App\Models\Kategori;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class BukuComponent extends Component
{
    use WithPagination, WithoutUrlPagination;
    protected $paginationTheme = 'bootstrap';
    public $kategori, $judul, $penulis, $penerbit, $isbn, $tahun, $jumlah, $cari, $id;

    public function render()
    {
        $data['buku'] = $this->cari != ''
            ? Buku::where('judul', 'like', '%' . $this->cari . '%')->paginate(10)
            : Buku::paginate(10);
        $data['category'] = Kategori::all();
        $layout['title'] = 'Kelola Buku';
        return view('livewire.buku-component', array_merge($data, $layout));
    }

    public function store()
    {
        $this->validate([
            'judul' => 'required',
            'kategori' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahun' => 'required',
            'isbn' => 'required',
            'jumlah' => 'required',
        ], [
            'judul.required' => 'Judul Buku Tidak Boleh Kosong!',
            'kategori.required' => 'Kategori Tidak Boleh Kosong!',
            'penulis.required' => 'Penulis Tidak Boleh Kosong!',
            'penerbit.required' => 'Penerbit Tidak Boleh Kosong!',
            'tahun.required' => 'Tahun Terbit Tidak Boleh Kosong!',
            'isbn.required' => 'ISBN Tidak Boleh Kosong!',
            'jumlah.required' => 'Jumlah Tidak Boleh Kosong!'
        ]);

        Buku::create([
            'judul' => $this->judul,
            'kategori_id' => $this->kategori,
            'penulis' => $this->penulis,
            'penerbit' => $this->penerbit,
            'tahun' => $this->tahun,
            'isbn' => $this->isbn,
            'jumlah' => $this->jumlah
        ]);
        $this->reset();
        session()->flash('success', 'Berhasil Tambah!');
        return redirect()->route('buku');
    }

    public function edit($id)
    {
        $buku = Buku::find($id);
        $this->id = $buku->id;
        $this->judul = $buku->judul;
        $this->kategori = $buku->kategori->id;
        $this->penulis = $buku->penulis;
        $this->penerbit = $buku->penerbit;
        $this->tahun = $buku->tahun;
        $this->isbn = $buku->isbn;
        $this->jumlah = $buku->jumlah;
    }

    public function update()
    {
        $buku = Buku::find($this->id);
        $buku->update([
            'judul' => $this->judul,
            'kategori_id' => $this->kategori,
            'penulis' => $this->penulis,
            'penerbit' => $this->penerbit,
            'tahun' => $this->tahun,
            'isbn' => $this->isbn,
            'jumlah' => $this->jumlah
        ]);
        $this->reset();
        session()->flash('success', 'Berhasil Ubah!');
        return redirect()->route('buku');
    }

    public function confirm($id)
    {
        $this->id = $id;
    }

    public function destroy()
    {
        $buku = Buku::find($this->id);
        $buku->delete();
        $this->reset();
        session()->flash('success', 'Berhasil Hapus!');
        return redirect()->route('buku');
    }
}
