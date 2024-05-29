@extends('layouts.management.master')

@section('content')
    <div class="pagetitle">
        <h1>Satuan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active">Satuan</li>
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
        <button type="button" class="btn btn-success mb-4" data-bs-toggle="modal"
            data-bs-target="#tambahSatuan">Tambah</button>
    </div>
    <div class="modal fade" id="tambahSatuan" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Satuan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('satuan.store') }}" method="post">
                        @csrf
                        <input type="text" name="satuan" id="satuan"
                            class="form-control  @error('satuan')
                        is-invalid
                    @enderror">
                        @error('satuan')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div><!-- End Tambah Kategori Modal-->

    <section>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">Master Data Satuan</div>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Satuan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($satuans as $satuan)
                                    <tr>
                                        <th>{{ $loop->iteration }}</th>
                                        <td>{{ $satuan->satuan }}</td>
                                        <td>
                                            {{-- Edit Satuan --}}
                                            <button type="button" class="btn btn-warning me-1" data-bs-toggle="modal"
                                                data-bs-target="#editSatuan{{ $satuan->id }}"><i
                                                    class="bi bi-pencil-square"></i></button>
                                            {{-- Modal Edit Satuan --}}
                                            <div class="modal fade" id="editSatuan{{ $satuan->id }}" tabindex="-1">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit Satuan</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('satuan.update', $satuan->id) }}"
                                                                method="post">
                                                                @method('put')
                                                                @csrf
                                                                <input type="text" name="satuan" id="satuan"
                                                                    class="form-control @error('satuan')
                                                                        is-invalid
                                                                    @enderror"
                                                                    value="{{ $satuan->satuan }}">
                                                                @error('satuan')
                                                                    <div class="text-danger">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Kembali</button>
                                                            <button type="submit" class="btn btn-primary">Update</button>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- End Edit Satuan --}}

                                            {{-- Hapus Satuan --}}
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#hapusSatuan{{ $satuan->id }}"><i
                                                    class="bi bi-trash"></i></button>

                                            <div class="modal fade" id="hapusSatuan{{ $satuan->id }}" tabindex="-1">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Konfirmasi Hapus Satuan</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <h5>Yakin ingin hapus satuan : {{ $satuan->satuan }}?
                                                            </h5>
                                                            <form action="{{ route('satuan.destroy', $satuan->id) }}"
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
