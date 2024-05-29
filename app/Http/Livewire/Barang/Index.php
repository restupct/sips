<?php

namespace App\Http\Livewire\Barang;

use App\Facades\Cart;
use App\Models\Barang;
use App\Models\Kategori;
use Livewire\Component;

class Index extends Component
{
    public $filteredBarangs;
    public $search;
    public $filter;
    protected $listeners = ['filter' => 'handleFilterBarang'];
    public function handleFilterBarang($barangs)
    {
        $this->filteredBarangs = $barangs;
    }
    public function render()
    {
        $barangs = Barang::query();
        if ($this->filter) {
            $barangs->where('kategori_id', $this->filter);
        }

        if ($this->search) {
            $barangs->where('nama_barang', 'like', '%' . $this->search . '%');
        }

        $barangs = $barangs->where('stok', '>', 0)->get();

        return view('livewire.barang.index', [
            'barangs' => $barangs,
            'kategoris' => Kategori::all()
        ])->extends('layouts.front.app');
}

    public function addToCart($barang_id)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        $barang = Barang::find($barang_id);
        Cart::add($barang);
        $this->emit('addToCart');
    }
}
