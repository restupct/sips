<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pelanggan;
use App\Models\Pesanan;
use App\Models\PesananBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PesananController extends Controller
{
    public function check(Pesanan $pesanan)
    {
        $pesanan = Pesanan::find($pesanan->id);
        $pesanan->update(['status' => 'Selesai']);
        return redirect('/admin/pesanan');
    }
    public function index()
    {
        $pesanans = Pesanan::with('pelanggan');
        if (request('status')) {
            $pesanans = $pesanans->where('status', request('status'));
        }
        $pesanans = $pesanans->orderBy('id', 'desc')->get();
        return view('admin.pesanan.index', ['pesanans' => $pesanans]);
    }

    public function create()
    {
        $pelanggans = Pelanggan::with('user')->get();
        $barangs = Barang::where('stok', '>', 0)->get();
        return view('admin.pesanan.create', ['pelanggans' => $pelanggans, 'barangs' => $barangs]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        if ($request->diskon) {
            $diskon = str_replace(".", "", $request->diskon);
        } else {
            $diskon = 0;
        }
        $id = Pesanan::latest('id')->first()->id ?? 0;
        $id++;
        $inputPesanan = [
            'pelanggan_id' => $request->pelanggan_id,
            'no_transaksi' => 'INV-' . $id,
            'tanggal' => $request->tanggal,
            'sub_total' => str_replace(".", "", $request->sub_total),
            'diskon' => $diskon,
            'total' => str_replace(".", "", $request->total),
            'status' => 'Belum Diproses'
        ];
        $pesanan = Pesanan::create($inputPesanan);
        // buat pesanan_barangs pesanan_id, barang_id, qty, sub_total
        $items = collect($data['barang_id'])->map(function ($barang_id, $index) use ($data) {
            return [
                'barang_id' => $barang_id,
                'harga_barang' => str_replace(".", "", $data['harga_barang'][$index]),
                'qty' => $data['qty'][$index],
                'sub_total' => str_replace(".", "", $data['sub_total_item'][$index]),
            ];
        });
        // dd($items);
        foreach ($items as $item) {
            PesananBarang::create([
                'pesanan_id' => $pesanan->id,
                'barang_id' => $item['barang_id'],
                'qty' => $item['qty'],
                'sub_total' => $item['sub_total'],
            ]);
            Barang::where('id', $item['barang_id'])->decrement('stok', $item['qty']);
        }
        return redirect('/admin/pesanan');
    }

    public function show(Pesanan $pesanan)
    {
        return view('admin.pesanan.show', ['pesanan' => $pesanan]);
    }

    public function edit(Pesanan $pesanan)
    {
        $pelanggans = Pelanggan::with('user')->get();
        $barangs = Barang::where('stok', '>', 0)->get();
        return view('admin.pesanan.edit', [
            'pesanan' => $pesanan,
            'pelanggans' => $pelanggans,
            'barangs' => $barangs
        ]);
    }

    public function update(Request $request, Pesanan $pesanan)
    {
        $data = $request->all();
        // dd($data);
        $items = collect($data['barang_id'])->map(function ($barang_id, $index) use ($data) {
            return [
                'barang_id' => $barang_id,
                'harga_barang' => str_replace(".", "", $data['harga_barang'][$index]),
                'qty' => $data['qty'][$index],
                'sub_total' => str_replace(".", "", $data['sub_total_item'][$index]),
            ];
        });
        // Hapus item lama
        foreach ($pesanan->barangs as $pesananBarang) {
            PesananBarang::where('pesanan_id', $pesananBarang->pivot->pesanan_id)->delete();
        }
        foreach ($items as $item) {
            PesananBarang::create([
                'pesanan_id' => $pesanan->id,
                'barang_id' => $item['barang_id'],
                'qty' => $item['qty'],
                'sub_total' => $item['sub_total'],
            ]);
        }
        $diskon = $request->diskon ? str_replace(".", "", $request->diskon) : 0;
        // Update tabel pesanan(pelanggan_id, sub_total, diskon, total)
        $pesanan->update([
            'pelanggan_id' => $request->pelanggan_id,
            'tanggal' => $request->tanggal,
            'sub_total' => str_replace(".", '', $request->sub_total),
            'diskon' => $diskon,
            'total' => str_replace(".", "", $request->total)
        ]);
        return redirect('/admin/pesanan');
    }

    public function destroy(Pesanan $pesanan)
    {
        foreach ($pesanan->barangs as $pesananBarang) {
            PesananBarang::where('pesanan_id', $pesananBarang->pivot->pesanan_id)->delete();
            Barang::where('id', $pesananBarang->pivot->barang_id)->increment('stok', $pesananBarang->pivot->qty);
        }
        $pesanan->delete();
        return redirect('/admin/pesanan');
    }

    // proses pesanan
    public function proses(Pesanan $pesanan)
    {
        $pesanan = Pesanan::find($pesanan->id);
        $pesanan->update(['status' => 'Diproses']);
        return redirect()->back();
    }

    public function kirim(Pesanan $pesanan)
    {
        $pesanan = Pesanan::find($pesanan->id);
        $pesanan->update(['status' => 'Dikirim']);
        return redirect()->back();
    }

    public function selesai(Pesanan $pesanan)
    {
        $pesanan = Pesanan::find($pesanan->id);
        $pesanan->update(['status' => 'Selesai']);
        return redirect()->back();
    }
}
