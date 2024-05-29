<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;

class BarangMasukController extends Controller
{
    public function index()
    {
        $barangs = BarangMasuk::with('barang')->get();
        return view('admin.barang_masuk.index', ['barangs' => $barangs]);
    }

    public function create()
    {
        $barangs = Barang::all();
        return view('admin.barang_masuk.create', [
            'barangs' => $barangs,
        ]);
    }

    public function store(Request $request)
    {
        // insert ke tabel barang_masuk
        $data = [
            'barang_id' => $request->barang_id,
            'tanggal' => $request->tanggal,
            'harga_beli' => str_replace('.', '', $request->harga_beli),
            'stok' => $request->stok,
        ];
        BarangMasuk::create($data);


        // update stok barang
        $barang = Barang::find($request->barang_id);
        $barang->stok += $request->stok;
        $barang->save();
        return redirect()->route('barang-masuk.index');
    }

    public function edit(BarangMasuk $barangMasuk)
    {
        $barangs = Barang::all();
        return view('admin.barang_masuk.edit', [
            'barangMasuk' => $barangMasuk,
            'barangs' => $barangs,
        ]);
    }

    public function update(Request $request, BarangMasuk $barangMasuk)
    {
        // update stok barang
        $barang = Barang::find($barangMasuk->barang_id);
        $barang->stok -= $barangMasuk->stok;
        $barang->stok += $request->stok;
        $barang->save();

        // update ke tabel barang_masuk
        $data = [
            'barang_id' => $request->barang_id,
            'tanggal' => $request->tanggal,
            'harga_beli' => str_replace('.', '', $request->harga_beli),
            'stok' => $request->stok,
        ];
        $barangMasuk->update($data);
        return redirect()->route('barang-masuk.index');
    }

    public function destroy(BarangMasuk $barangMasuk)
    {
        // update stok barang
        $barang = Barang::find($barangMasuk->barang_id);
        $barang->stok -= $barangMasuk->stok;
        $barang->save();
        $barangMasuk->delete();
        return redirect()->route('barang-masuk.index');
    }
}
