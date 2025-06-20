<?php

namespace App\Livewire;

use Livewire\Component;

class HomeComponent extends Component
{
    public function render()
    {
        $x['title']="Halaman Perpustakaan";
        return view('livewire.home-component')->with($x);
    }
}
