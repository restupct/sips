@extends('layouts.management.master')

@section('content')
    <div class="pagetitle">
        <h1>Tambah Stok Barang</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active">Barang Masuk</li>
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
        <a href="{{ route('barang-masuk.create') }}" class="btn btn-success mb-3">Tambah Stok Barang</a>
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
                                    <th>Tanggal Beli</th>
                                    <th>Qty</th>
                                    <th>Harga Beli</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($barangs as $barang)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $barang->barang->nama_barang }}</td>
                                        <td>{{ \Carbon\Carbon::parse($barang->tanggal)->locale('id')->isoFormat('D MMMM Y') }}
                                        <td>{{ $barang->stok }} {{ $barang->barang->satuan->satuan }}</td>
                                        <td>Rp. {{ number_format($barang->harga_beli, 0, ',', '.') }}</td>
                                        <td>
                                            <a href="{{ route('barang-masuk.edit', $barang->id) }}"
                                                class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>
                                            <form style="display: inline"
                                                action="{{ route('barang-masuk.destroy', $barang->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"><i
                                                        class="bi bi-trash"></i></button>
                                            </form>
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
