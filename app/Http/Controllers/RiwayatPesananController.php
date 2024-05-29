<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;

class RiwayatPesananController extends Controller
{
    public function index()
    {
        $pesanan_pelanggans = auth()->user()->pelanggan->pesanans()->orderBy('tanggal', 'desc')->get();
        return view('front.riwayat.index', [
            'pesanan_pelanggans' => $pesanan_pelanggans
        ]);
    }
    public function detail($id)
    {
        $pesanan_pelanggan = Pesanan::with('barangs')->where('id', $id)->first();
        return view('front.riwayat.detail', ['pesanan_pelanggan' => $pesanan_pelanggan]);
    }
}
