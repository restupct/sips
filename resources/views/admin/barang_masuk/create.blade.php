@extends('layouts.management.master')

@section('content')
    <div class="pagetitle">
        <h1>Tambah Stok Barang</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('barang-masuk.index') }}">Barang</a></li>
                <li class="breadcrumb-item active">Tambah Stok Barang</li>
            </ol>
        </nav>
    </div>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('barang-masuk.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group my-2">
                            <h5 class="card-title">Nama Barang</h5>
                            <select name="barang_id" id="barang_id" class="form-select">
                                <option value="">-- Pilih Barang --</option>
                                @foreach ($barangs as $barang)
                                    <option value="{{ $barang->id }}">{{ $barang->nama_barang }}</option>
                                @endforeach
                            </select>
                            @error('barang_id')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group my-2">
                            <h5 class="card-title">Tanggal</h5>
                            <input type="date" name="tanggal" id="tanggal" class="form-control"
                                value="{{ date('Y-m-d') }}">
                            @error('tanggal')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group my-2">
                            <h5 class="card-title">Harga Beli</h5>
                            <div class="input-group">
                                <span class="input-group-text">Rp.</span>
                                <input type="text" class="form-control @error('harga_beli') is-invalid @enderror"
                                    value="{{ old('harga_beli') }}" placeholder="Harga Beli" id="harga_beli"
                                    name="harga_beli">
                                @error('harga_beli')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group my-2">
                            <h5 class="card-title">Stok</h5>
                            <input type="number" class="form-control @error('stok') is-invalid @enderror"
                                value="{{ old('stok') }}" placeholder="Stok" id="stok" name="stok">
                            @error('stok')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                </div>
                <div class="col d-flex justify-content-center mt-4">
                    <a class="btn btn-warning text-dark me-4" href="#">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
    </div>
@endsection
@section('js')
    <script>
        const inputHarga = document.getElementById('harga_beli');
        inputHarga.addEventListener('input', formatInput);
        inputHarga.addEventListener('change', formatInput);

        function formatInput(e) {
            let value = parseInt(e.target.value.replace(/\D/g, ''));
            e.target.value = isNaN(value) ? 0 : value.toLocaleString('id-ID');
        }
    </script>
@endsection
