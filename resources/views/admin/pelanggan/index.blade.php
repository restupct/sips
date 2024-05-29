@extends('layouts.management.master')

@section('content')
    <div class="pagetitle">
        <h1>Pelanggan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active">Pelanggan</li>
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
        <a href="{{ route('pelanggan.create') }}" class="btn btn-success mb-3">Tambah</a>
    </div>

    <section>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">Master Data Pelanggan</div>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>No. Telepon</th>
                                    <th>Alamat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pelanggans as $pelanggan)
                                    <tr>
                                        <th>{{ $loop->iteration }}</th>
                                        <td>{{ $pelanggan->user->name }}</td>
                                        <td>{{ $pelanggan->no_telepon }}</td>
                                        <td>{{ $pelanggan->alamat }}</td>

                                        <td>
                                            <a href="{{ route('pelanggan.show', $pelanggan->id) }}"
                                                class="btn btn-primary me-1"><i class="bi bi-eye"></i></a>

                                            <a href="{{ route('pelanggan.edit', $pelanggan->id) }}"
                                                class="btn btn-warning me-1"><i class="bi bi-pencil-square"></i></a>

                                            {{-- Hapus Pelanggan --}}
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#hapusPelanggan{{ $pelanggan->id }}"><i
                                                    class="bi bi-trash"></i></button>

                                            <div class="modal fade" id="hapusPelanggan{{ $pelanggan->id }}" tabindex="-1">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Konfirmasi Hapus Pelanggan</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <h5>Yakin ingin hapus {{ $pelanggan->user->name }}?
                                                            </h5>
                                                            <form action="{{ route('pelanggan.destroy', $pelanggan->id) }}"
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
