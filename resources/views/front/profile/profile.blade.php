@extends('layouts.front.app')
@section('content')
    <div class="container">
        <div class="row mt-4 pt-4">
{{--            <div class="col-md-3 d-sm-none">--}}
{{--                <div class="bg-light shadow rounded-3 py-3 p-0 w-100">--}}
{{--                    <!-- Dashboard menu -->--}}
{{--                    <div class="list-group list-group-dark list-group-borderless">--}}
{{--                        <a class="list-group-item {{ request()->is('profile*') ? 'active' : '' }}"--}}
{{--                            href="{{ route('profile') }}">--}}
{{--                            <i class="bi bi-person-fill fa-fw me-2"></i>Profile</a>--}}
{{--                        <a class="list-group-item {{ request()->is('riwayat*') ? 'active' : '' }}"--}}
{{--                            href="{{ route('riwayat.pesanan') }}">--}}
{{--                            <i class="bi bi-file-text-fill fa-fw me-2"></i>Riwayat Pesanan</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
            <div class="col-md-9 pt-3">
                <div class="card">
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form action="{{ route('update.profile') }}" method="post" enctype="multipart/form-data">
                            <div class="row">
                                @csrf
                                {{-- Picture --}}
                                <div class="col justify-content-center align-items-center">
                                    <span class="avatar avatar-xxl">
                                        @if (empty($profile->pelanggan->foto))
                                            <img id="uploadfile-1-preview"
                                                class="avatar-img img-preview rounded-circle shadow"
                                                src="{{ asset('template/admin/assets/img/user2.png') }}" alt=""
                                                style="width: 100px">
                                        @else
                                            <img id="uploadfile-1-preview"
                                                class="avatar-img img-preview rounded-circle shadow"
                                                src="{{ asset('storage/' . $profile->pelanggan->foto) }}"
                                                alt=""style="width: 100px">
                                        @endif
                                    </span>
                                    <input type="file" name="foto" id="foto" class="form-control mt-3">
                                </div>
                                {{-- Nama --}}
                                <div class="col-12 mt-3">
                                    <label class="form-label">Nama</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            placeholder="Nama" value="{{ $profile->name }}" name="name">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                {{-- No telepon --}}
                                <div class="col-md-6 mt-3">
                                    <label class="form-label">No Telepon</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control @error('no_telepon') is-invalid @enderror"
                                            placeholder="No Telepon" value="{{ $profile->pelanggan->no_telepon }}"
                                            name="no_telepon">
                                        @error('no_telepon')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                {{-- Alamat --}}
                                <div class="col-md-6 mt-3">
                                    <label class="form-label">Alamat</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control @error('alamat') is-invalid @enderror"
                                            placeholder="Alamat" value="{{ $profile->pelanggan->alamat }}" name="alamat">
                                        @error('alamat')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                {{-- Username --}}
                                <div class="col-md-6 mt-3">
                                    <label class="form-label">Username</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control @error('username') is-invalid @enderror"
                                            placeholder="Username" value="{{ $profile->username }}" name="username">
                                        @error('username')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                {{-- Password --}}
                                <div class="col-md-6 mt-3">
                                    <label class="form-label">Password</label>
                                    <div>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                            placeholder="Password" name="password">
                                        <span class="text-danger">Kosongi jika tidak ingin merubah</span>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    {{-- @dump($profile) --}}
                </div>
            </div>
        </div>
    </div>
@endsection
