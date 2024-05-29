@extends('layouts.management.master')

@section('content')
    <div class="pagetitle">
        <h1>Edit Pelanggan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('pelanggan.index') }}">Pelanggan</a></li>
                <li class="breadcrumb-item active">Edit Pelanggan</li>
            </ol>
        </nav>
    </div>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('pelanggan.update', $pelanggan->id) }}" method="post" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group my-2">
                            <h5 class="card-title">Foto</h5>
                            <img class="mb-3" src="{{ asset('storage/' . $pelanggan->foto) }}" style="height: 100px"
                                alt="">
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
                            {{-- set value from database or old value --}}
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name') ?? $pelanggan->user->name }}" placeholder="Nama Pelanggan"
                                id="name" name="name">
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
                                value="{{ old('username') ?? $pelanggan->user->username }}" placeholder="Username"
                                id="username" name="username">
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
                                placeholder="Password" id="password" name="password">
                            <span class="text-danger">* Kosongkan jika tidak ingin mengganti password</span>
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
                                value="{{ old('no_telepon') ?? $pelanggan->no_telepon }}" placeholder="No Telepon"
                                id="no_telepon" name="no_telepon">
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
                                value="{{ old('alamat') ?? $pelanggan->alamat }}" placeholder="Alamat" id="alamat"
                                name="alamat">
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
@endsection
