@extends('layouts.management.master')

@section('content')
    <div class="pagetitle">
        <h1>Tambah Pelanggan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('pelanggan.index') }}">Pelanggan</a></li>
                <li class="breadcrumb-item active">Tambah Pelanggan</li>
            </ol>
        </nav>
    </div>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('pelanggan.store') }}" method="post" enctype="multipart/form-data">
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
                            <h5 class="card-title">Nama Pelanggan</h5>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name') }}" placeholder="Nama Pelanggan" id="name" name="name">
                            @error('name')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group my-2">
                            <h5 class="card-title">Username</h5>
                            <input type="text" class="form-control @error('username') is-invalid @enderror"
                                value="{{ old('username') }}" placeholder="Username" id="username" name="username">
                            @error('username')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group my-2">
                            <h5 class="card-title">Password</h5>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                value="{{ old('password') }}" placeholder="Password" id="password" name="password">
                            @error('password')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group my-2">
                            <h5 class="card-title">No Telepon</h5>
                            <input type="text" class="form-control @error('no_telepon') is-invalid @enderror"
                                value="{{ old('no_telepon') }}" placeholder="No Telepon" id="no_telepon" name="no_telepon">
                            @error('no_telepon')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group my-2">
                            <h5 class="card-title">Alamat</h5>
                            <input type="text" class="form-control @error('alamat') is-invalid @enderror"
                                value="{{ old('alamat') }}" placeholder="Alamat" id="alamat" name="alamat">
                            @error('alamat')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>



                </div>
                <div class="col d-flex justify-content-center mt-4">
                    <a class="btn btn-warning text-dark me-4" href="{{ route('pelanggan.index') }}">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
    </div>
@endsection
