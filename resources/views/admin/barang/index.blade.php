@extends('layouts.management.master')

@section('content')
    <div class="pagetitle">
        <h1>Barang</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active">Barang</li>
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
        <a href="{{ route('barang.create') }}" class="btn btn-success mb-3">Tambah Barang</a>
    </div>

    <section>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">Master Data Barang</div>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Barang</th>
                                    <th>Foto</th>
                                    <th>Stok</th>
                                    <th>Harga</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($barangs as $barang)
                                    <tr>
                                        <th>{{ $loop->iteration }}</th>
                                        <td>{{ $barang->nama_barang }}</td>
                                        <td><img style="height: 100px" src="{{ asset('storage/' . $barang->foto) }}"
                                                alt=""></td>
                                        <td>{{ $barang->stok }} {{ $barang->satuan->satuan }}</td>
                                        <td>Rp. {{ number_format($barang->harga, 0, ',', '.') }}</td>
                                        <td>
                                            <a href="{{ route('barang.edit', $barang->id) }}"
                                                class="btn btn-warning me-1"><i class="bi bi-pencil-square"></i></a>
                                            {{-- Hapus Barang --}}
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#hapusBarang{{ $barang->id }}"><i
                                                    class="bi bi-trash"></i></button>

                                            <div class="modal fade" id="hapusBarang{{ $barang->id }}" tabindex="-1">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Konfirmasi Hapus Barang</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <h5>Yakin ingin hapus {{ $barang->nama_barang }}?
                                                            </h5>
                                                            <form action="{{ route('barang.destroy', $barang->id) }}"
                                                                method="post">
                                                                @method('delete')
                                                                @csrf
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div><!-- End Delete Satuan Modal-->
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
