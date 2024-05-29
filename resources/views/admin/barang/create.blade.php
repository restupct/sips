@extends('layouts.management.master')

@section('content')
    <div class="pagetitle">
        <h1>Tambah Barang</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('barang.index') }}">Barang</a></li>
                <li class="breadcrumb-item active">Tambah Barang</li>
            </ol>
        </nav>
    </div>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('barang.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group my-2">
                            <h5 class="card-title">Foto</h5>
                            <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto"
                                name="foto">
                            @error('foto')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group my-2">
                            <h5 class="card-title">Nama Barang</h5>
                            <input type="text" class="form-control @error('nama_barang') is-invalid @enderror"
                                value="{{ old('nama_barang') }}" placeholder="Nama Barang" id="nama_barang"
                                name="nama_barang">
                            @error('nama_barang')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group my-2">
                            <h5 class="card-title">Stok</h5>
                            <input readonly type="number" class="form-control @error('stok') is-invalid @enderror"
                                value="0" placeholder="Stok" id="stok" name="stok">
                            @error('stok')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    {{-- Satuan --}}
                    <div class="col-md-6">
                        <div class="form-group my-2">
                            <h5 class="card-title">Satuan</h5>
                            <select
                                class="form-select @error('satuan_id')
                                is-invalid
                            @enderror"
                                name="satuan_id" id="satuan_id">
                                <option value="">Pilih Satuan</option>
                                @foreach ($satuans as $satuan)
                                    <option value="{{ $satuan->id }}"
                                        {{ old('satuan_id') == $satuan->id ? 'selected' : '' }}>{{ $satuan->satuan }}
                                    </option>
                                @endforeach
                            </select>
                            @error('satuan_id')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    {{-- End Satuan --}}

                    <div class="col-md-6">
                        <div class="form-group my-2">
                            <h5 class="card-title">Harga</h5>
                            <input type="number" class="form-control @error('harga') is-invalid @enderror"
                                value="{{ old('harga') }}" placeholder="Harga" id="harga" name="harga">
                            @error('harga')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>


                    {{-- Kategori --}}
                    <div class="col-md-6">
                        <div class="form-group my-2">
                            <h5 class="card-title">Kategori</h5>
                            <select
                                class="form-select @error('kategori_id')
                                is-invalid
                            @enderror"
                                name="kategori_id" id="kategori_id">
                                <option value="">Pilih Kategori</option>
                                @foreach ($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}"
                                        {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                        {{ $kategori->kategori }}</option>
                                @endforeach
                            </select>
                            @error('kategori_id')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    {{-- End Kategori --}}

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
