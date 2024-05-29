<?php

namespace App\Http\Livewire\Barang;

use App\Models\Barang;
use App\Models\Kategori;
use Livewire\Component;

class Filter extends Component
{
    public $filter;
    public $search;
    public function render()
    {
        if ($this->filter) {
            $this->emit('filter', $this->filter);
        }
        return view('livewire.barang.filter', [
            'kategoris' => Kategori::all()
        ]);
    }
}
