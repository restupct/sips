<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\Pelanggan;
use App\Models\Pesanan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Tentukan tanggal awal dan akhir minggu
        $today = Carbon::now();
        $today = $today->format('Y-m-d');
        $startDate = Carbon::now()->startOfWeek();
        $endDate = Carbon::now()->endOfWeek();

        if (request('filter') == 'minggu-ini') {
            $tanggalPengeluaran = BarangMasuk::select('tanggal')
                ->whereBetween('tanggal', [$startDate, $endDate])
                ->groupBy('tanggal')
                ->orderBy('tanggal', 'asc')
                ->get();

            $tanggalPendapatan = Pesanan::select('tanggal')
                ->where('status', 'Selesai')
                ->whereBetween('tanggal', [$startDate, $endDate])
                ->groupBy('tanggal')
                ->orderBy('tanggal', 'asc')
                ->get();
        } elseif (request('filter') == 'hari-ini') {
            $tanggalPengeluaran = BarangMasuk::select('tanggal')
                ->where('tanggal', $today)
                ->groupBy('tanggal')
                ->orderBy('tanggal', 'asc')
                ->get();

            $tanggalPendapatan = Pesanan::select('tanggal')
                ->where('status', 'Selesai')
                ->where('tanggal', $today)
                ->groupBy('tanggal')
                ->orderBy('tanggal', 'asc')
                ->get();
        } else {
            $tanggalPengeluaran = BarangMasuk::select('tanggal')->groupBy('tanggal')->orderBy('tanggal', 'asc')->get();
            $tanggalPendapatan = Pesanan::select('tanggal')->where('status', 'Selesai')->groupBy('tanggal')->orderBy('tanggal', 'asc')->get();
        }
        $pesanans = Pesanan::with(['barangs', 'pelanggan'])->orderBy('id', 'desc')->limit(5)->get();
        $barangs = Barang::with('satuan')->where('stok', '<', 10)->orderBy('id', 'desc')->limit(5)->get();
        $jumlahPesanan = Pesanan::count();
        $jumlahPesananSelesai = Pesanan::where('status', 'Selesai')->count();
        $jumlahPesananBelumDiproses = Pesanan::where('status', 'Belum Diproses')->count();
        $jumlahPelanggan = Pelanggan::count();
        $pendapatan = Pesanan::where('status', 'Selesai')->sum('total');
        $pengeluaran = BarangMasuk::with('barang')->sum('harga_beli');


        $pengeluaranPerTanggal = [];
        $pendapatanPerTanggal = [];
        foreach ($tanggalPengeluaran as $tanggal) {
            $pengeluaranPerTanggal[] = [
                'tanggal' => $tanggal->tanggal,
                'total' => BarangMasuk::where('tanggal', $tanggal->tanggal)->sum('harga_beli')
            ];
        }

        foreach ($tanggalPendapatan as $tanggal) {
            $pendapatanPerTanggal[] = [
                'tanggal' => $tanggal->tanggal,
                'total' => Pesanan::where('tanggal', $tanggal->tanggal)->where('status', 'Selesai')->sum('total')
            ];
        }
        // Membuat array baru untuk menyimpan hasil
        $combined = [];
        // Menambahkan semua tanggal dan total dari pengeluaranPerTanggal ke array baru
        foreach ($pengeluaranPerTanggal as $data) {
            $combined[$data['tanggal']] = ['totalPengeluaran' => $data['total'], 'totalPendapatan' => 0];
        }

        // Menambahkan semua tanggal dan total dari pendapatanPerTanggal ke array baru
        // Jika tanggal sudah ada, update totalPendapatan. Jika tidak, tambahkan tanggal dengan totalPendapatan dan totalPengeluaran 0
        foreach ($pendapatanPerTanggal as $data) {
            if (isset($combined[$data['tanggal']])) {
                $combined[$data['tanggal']]['totalPendapatan'] = $data['total'];
            } else {
                $combined[$data['tanggal']] = ['totalPendapatan' => $data['total'], 'totalPengeluaran' => 0];
            }
        }

        // Mengubah array asosiatif menjadi array numerik dan menambahkan tanggal ke setiap entri
        $result = [];
        foreach ($combined as $tanggal => $data) {
            $data['tanggal'] = $tanggal;
            $result[] = $data;
        }
        // urutkan result berdasarkan tanggal
        usort($result, function ($a, $b) {
            return strtotime($a['tanggal']) - strtotime($b['tanggal']);
        });

        $tanggal = array_map(function ($item) {
            return date('j M', strtotime($item['tanggal']));
        }, $result);

        $pengeluarans = array_map(function ($item) {
            return $item['totalPengeluaran'];
        }, $result);

        $pendapatanPerTanggal = array_map(function ($item) {
            return $item['totalPendapatan'];
        }, $result);

        return view('admin.index', [
            'pesanans' => $pesanans,
            'barangs' => $barangs,
            'jumlahPesanan' => $jumlahPesanan,
            'jumlahPesananSelesai' => $jumlahPesananSelesai,
            'jumlahPesananBelumDiproses' => $jumlahPesananBelumDiproses,
            'jumlahPelanggan' => $jumlahPelanggan,
            'pendapatan' => $pendapatan,
            'pengeluaran' => $pengeluaran,
            'tanggal' => $tanggal,
            'pengeluarans' => $pengeluarans,
            'pendapatanPerTanggal' => $pendapatanPerTanggal,
        ]);
    }
}
