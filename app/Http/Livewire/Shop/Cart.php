<?php

namespace App\Http\Livewire\Shop;

use App\Facades\Cart as FacadesCart;
use App\Models\Barang;
use App\Models\Pesanan;
use App\Models\PesananBarang;
use Barryvdh\Debugbar\Facade;
use Livewire\Component;

class Cart extends Component
{
    public $cart;
    public $barangs = [];
    public $harga;
    public $qty;
    public $total;
    public $totalHargaPerBarang = 0;

    public function updateQty($barang_id, $newQty)
    {
        // Cari barang di dalam keranjang berdasarkan id
        foreach ($this->cart['barangs'] as $index => $barang) {
            if ($barang['id'] == $barang_id) {
                // Perbarui kuantitas barang
                $this->cart['barangs'][$index]['qty'] = $newQty;

                // Perbarui total harga per barang
                $this->cart['barangs'][$index]['harga_total'] = $barang['harga'] * $newQty;
            }
        }

        FacadesCart::set($this->cart);
        $this->total = collect($this->cart['barangs'])->sum('harga_total');
    }
    public function mount()
    {
        $this->cart = FacadesCart::get();
        // sum the harga price
        $this->total = collect($this->cart['barangs'])->sum('harga_total');
    }
    public function render()
    {
        return view('livewire.shop.cart')->extends('layouts.front.app');
    }
    public function removeFromCart($barang_id)
    {
        FacadesCart::remove($barang_id);
        $this->cart = FacadesCart::get();
        $this->total = collect($this->cart['barangs'])->sum('harga');

        $this->emit('removeFromCart');
    }

    public function pesan()
    {
        $this->cart = FacadesCart::get();
        if ($this->cart['barangs'] == null) {
            return redirect()->route('home')->with('error', 'Keranjangmu masih kosong');
        }
        // simpan data ke tabel pesanan
        $id = Pesanan::latest('id')->first()->id ?? 0;
        $id++;
        $inputPesanan = [
            'no_transaksi' => 'INV-' . $id,
            'pelanggan_id' => auth()->user()->pelanggan->id,
            'tanggal' => date('Y-m-d'),
            'sub_total' => str_replace(".", "", $this->total),
            'diskon' => 0,
            'total' => str_replace(".", "", $this->total),
            'status' => 'Belum Diproses'
        ];
        $pesanan = Pesanan::create($inputPesanan);
        // make collection from cart
        $items = collect($this->cart['barangs'])->map(function ($barang) {
            return [
                'barang_id' => $barang['id'],
                'qty' => $barang['qty'],
                'sub_total' => $barang['harga']
            ];
        });
        // save to pesanan_barangs table from $items collection
        foreach ($items as $item) {
            PesananBarang::create([
                'pesanan_id' => $pesanan->id,
                'barang_id' => $item['barang_id'],
                'qty' => $item['qty'],
                'sub_total' => $item['sub_total'],
            ]);
            Barang::where('id', $item['barang_id'])->decrement('stok', 1);
        }
        // clear cart
        FacadesCart::clear();
        return redirect()->route('home')->with('success', 'Pesananmu berhasil dibuat, tunggu barang dikirim oleh penjual ya!');
    }
}
