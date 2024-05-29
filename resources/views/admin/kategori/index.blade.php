@extends('layouts.management.master')

@section('content')
    <div class="pagetitle">
        <h1>Kategori</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active">Kategori</li>
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
            data-bs-target="#tambahKategori">Tambah</button>
    </div>
    <div class="modal fade" id="tambahKategori" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('kategori.store') }}" method="post">
                        @csrf
                        <input type="text" name="kategori" id="kategori" class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div><!-- End Disabled Backdrop Modal-->

    <section>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">Master Data Kategori</div>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Kategori</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kategoris as $kategori)
                                    <tr>
                                        <th>{{ $loop->iteration }}</th>
                                        <td>{{ $kategori->kategori }}</td>
                                        <td>
                                            {{-- Edit Kategori --}}
                                            <button type="button" class="btn btn-warning me-1" data-bs-toggle="modal"
                                                data-bs-target="#editKategori{{ $kategori->id }}"><i
                                                    class="bi bi-pencil-square"></i></button>
                                            {{-- Modal Edit Kategori --}}
                                            <div class="modal fade" id="editKategori{{ $kategori->id }}" tabindex="-1">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit Kategori</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('kategori.update', $kategori->id) }}"
                                                                method="post">
                                                                @method('put')
                                                                @csrf
                                                                <input type="text" name="kategori" id="kategori"
                                                                    class="form-control" value="{{ $kategori->kategori }}">
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
                                            {{-- End Edit Kategori --}}

                                            {{-- Hapus Kategori --}}
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#hapusKategori{{ $kategori->id }}"><i
                                                    class="bi bi-trash"></i></button>

                                            <div class="modal fade" id="hapusKategori{{ $kategori->id }}" tabindex="-1">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Konfirmasi Hapus Kategori</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <h5>Yakin ingin hapus kategori : {{ $kategori->kategori }}?
                                                            </h5>
                                                            <form action="{{ route('kategori.destroy', $kategori->id) }}"
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
                                            </div><!-- End Delete Kategori Modal-->
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
