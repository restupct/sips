@extends('layouts.management.master')

@section('content')
    <div class="pagetitle">
        <h1>Pesanan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active">Pesanan</li>
            </ol>
        </nav>
    </div>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div>
        <a href="{{ route('pesanan.create') }}" class="btn btn-success mb-3">Tambah</a>
    </div>

    <section>
        <div class="row">
            <div class="col-12">
                {{-- <div class="card">
                    <div class="card-body"></div>
                </div> --}}
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <div class="row justify-content-between">
                                <div class="col-md-3">Master Data Pesanan</div>
                                <div class="col-md-3">
                                    <form class="d-flex align-items-center">
                                        <select name="status" id="status" class="form-select">
                                            <option value="">-- Pilih Status --</option>
                                            <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>
                                                Selesai</option>
                                            <option value="Belum Diproses"
                                                {{ request('status') == 'Belum Diproses' ? 'selected' : '' }}>
                                                Belum Diproses</option>
                                        </select>
                                        <button type="submit" class="btn btn-primary ms-3"><i
                                                class="bi bi-search"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>No. Transaksi</th>
                                    <th>Tanggal</th>
                                    <th>Pelanggan</th>
                                    <th>Total Harga</th>
                                    <th>Status</th>
                                    <th style="text-align: center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pesanans as $pesanan)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $pesanan->no_transaksi }}</td>
                                        <td>{{ \Carbon\Carbon::parse($pesanan->tanggal)->locale('id')->isoFormat('D MMMM Y') }}
                                        </td>
                                        <td>{{ $pesanan->pelanggan->user->name }}</td>
                                        <td>Rp. {{ number_format($pesanan->total, 0, ',', '.') }}</td>
                                        <td>
                                            @if ($pesanan->status == 'Belum Diproses')
                                                <span class="badge bg-primary">{{ $pesanan->status }}</span>
                                            @elseif($pesanan->status == 'Diproses')
                                                <span class="badge bg-warning">{{ $pesanan->status }}</span>
                                            @elseif($pesanan->status == 'Dikirim')
                                                <span class="badge bg-info">{{ $pesanan->status }}</span>
                                            @elseif($pesanan->status == 'Selesai')
                                                <span class="badge bg-success">{{ $pesanan->status }}</span>
                                            @endif
                                        </td>
                                        <td class="d-flex justify-content-center align-items-center flex-wrap">
                                            @if ($pesanan->status == 'Proses')
                                                <a href="{{ route('pesanan.check', $pesanan->id) }}"
                                                    class="btn btn-info me-2"><i class="bi bi-check-circle"></i></a>
                                            @endif
                                            <a href="{{ route('pesanan.show', $pesanan->id) }}"
                                                class="btn btn-primary me-2"><i class="bi bi-eye"></i></a>
                                            <a href="{{ route('pesanan.edit', $pesanan->id) }}"
                                                class="btn btn-warning me-2"><i class="bi bi-pencil-square"></i></a>
                                            <form style="display: inline"
                                                action="{{ route('pesanan.destroy', $pesanan->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"><i
                                                        class="bi bi-trash"></i></button>
                                            </form>
                                        </td>
                                    @empty
                                        <td colspan="7" style="text-align: center">Belum Ada Pesanan</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
