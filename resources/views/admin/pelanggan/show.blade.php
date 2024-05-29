@extends('layouts.management.master')

@section('content')
    <div class="pagetitle">
        <h1>Detail Pelanggan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('pelanggan.index') }}">Pelanggan</a></li>
                <li class="breadcrumb-item active">Detail Pelanggan</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header h5 fw-bold text-black d-flex justify-content-between">
                    <div>Detail Pelanggan</div>
                    <div>
                        <a href="{{ route('pelanggan.index') }}" class="btn btn-warning">Kembali</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row px-2">
                        <div class="col-md-4 text-center">
                            @if ($pelanggan->foto)
                                <img src="{{ asset('storage/' . $pelanggan->foto) }}" alt="" class="img-fluid"
                                    width="200">
                            @else
                                <img src="{{ asset('template/admin/assets/img/user2.png') }}" alt=""
                                    class="img-fluid" width="200">
                            @endif
                        </div>
                        {{-- Detail Pelanggan --}}
                        <div class="col-md-8">
                            <table class="table table-striped">
                                <tr>
                                    <th>Nama</th>
                                    <td>{{ $pelanggan->user->name }}</td>
                                </tr>
                                <tr>
                                    <th>No. Telepon</th>
                                    <td>{{ $pelanggan->no_telepon }}</td>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <td>{{ $pelanggan->alamat }}</td>
                                </tr>
                                <tr>
                                    <th>Jumlah Pesanan</th>
                                    <td>{{ $pesanan_pelanggans->count() }} Pesanan</td>
                                </tr>
                                {{-- <tr>
                                    <th>Total Pemesanan</th>
                                    <td>Rp. {{ number_format($pesanan_pelanggans->sum('total'), 0, ',', '.') }}</td>
                                </tr> --}}
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-header h5 fw-bold text-black">Pesanan</div>
                <div class="card-body">
                    {{-- @dd($pesanan_pelanggan) --}}
                    <table class="table datatable table-striped">
                        <thead>
                            <th>#</th>
                            <th>No. Transaksi</th>
                            <th>Tanggal</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody>
                            @foreach ($pesanan_pelanggans as $pesanan_pelanggan)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $pesanan_pelanggan->no_transaksi }}</td>
                                    <td>{{ \Carbon\Carbon::parse($pesanan_pelanggan->tanggal)->locale('id')->isoFormat('D MMMM Y') }}
                                    </td>
                                    <td>Rp. {{ number_format($pesanan_pelanggan->total, 0, ',', '.') }}</td>
                                    <td>
                                        @if ($pesanan_pelanggan->status == 'Belum Diproses')
                                            <span class="badge bg-primary">{{ $pesanan_pelanggan->status }}</span>
                                        @elseif($pesanan_pelanggan->status == 'Diproses')
                                            <span class="badge bg-warning">{{ $pesanan_pelanggan->status }}</span>
                                        @elseif($pesanan_pelanggan->status == 'Dikirim')
                                            <span class="badge bg-info">{{ $pesanan_pelanggan->status }}</span>
                                        @elseif($pesanan_pelanggan->status == 'Selesai')
                                            <span class="badge bg-success">{{ $pesanan_pelanggan->status }}</span>
                                        @endif
                                    </td>
                                    <td><a href="{{ route('pesanan.show', $pesanan_pelanggan->id) }}"
                                            class="btn btn-primary me-2"><i class="bi bi-eye"></i> Detail</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
