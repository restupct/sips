@extends('layouts.management.master')

@section('content')
    <div class="d-flex justify-content-between">
        <div class="pagetitle">
            <h1>Detail Pesanan</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('pesanan.index') }}">Pesanan</a></li>
                    <li class="breadcrumb-item active">Detail</li>
                </ol>
            </nav>
            @if ($pesanan->status == 'Selesai')
                <div class="alert alert-info" role="alert">
                    Barang sudah dikirim dan sudah dibayar
                </div>
            @endif
            @if ($pesanan->status == 'Belum Diproses')
                <a href="{{ route('pesanan.proses', $pesanan->id) }}" class="btn btn-warning">
                    <i class="bi bi-check"></i> Proses
                </a>
            @elseif ($pesanan->status == 'Diproses')
                <a href="{{ route('pesanan.kirim', $pesanan->id) }}" class="btn btn-info text-white">
                    <i class="bi bi-check"></i> Kirim
                </a>
            @elseif ($pesanan->status == 'Dikirim')
                <a href="{{ route('pesanan.selesai', $pesanan->id) }}" class="btn btn-success text-white">Selesai</a>
            @endif
        </div>
    </div>
    <div class="row g-4">
        <div class="col-12">
            <div class="mb-4">

                <!-- Invoice Logo-->
                {{-- <div class="clearfix"> --}}
                {{-- <div class="float-start mb-3"> --}}
                {{-- <img src="/template/dist/assets/images/logo-dark.png" alt="dark logo" height="22"> --}}
                {{-- </div> --}}
                {{-- <div class="float-start mb-3"> --}}
                {{-- <h4 class="m-0 d-print-none">Detail Pesanan</h4> --}}
                {{-- </div> --}}
                {{-- </div> --}}
                {{-- @dd($pesanan) --}}
                <!-- Invoice Detail-->
                <div class="card">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mt-3 float-start">
                                    <p class="fs-13"><strong>No. Transaksi : </strong> <span class="float-end">
                                            {{ $pesanan->no_transaksi }}</span></p>
                                    <p class="fs-13"><strong>Tanggal : </strong>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        {{ \Carbon\Carbon::parse($pesanan->created_at)->locale('id')->isoFormat('D MMMM Y') }}
                                    </p>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="float-end mt-3">
                                    <p class="fs-13"><strong>Pelanggan : </strong> {{ $pesanan->pelanggan->user->name }}
                                    </p>
                                    <p class="fs-13"><strong>Alamat : </strong> {{ $pesanan->pelanggan->alamat }}</p>
                                    <p class="fs-13"><strong>No. Telepon / WA : </strong>
                                        {{ $pesanan->pelanggan->no_telepon }}</p>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                    </div>
                </div>

                <div class="row mb-4 justify-content-center">
                    <div class="col-md-12">
                        <div class="table-responsive text-center">
                            <table class="table table-sm table-centered table-hover table-borderless mb-0 mt-3">
                                <thead class="border-top border-bottom bg-light-subtle border-light">
                                    <tr class="table-secondary">
                                        <th>#</th>
                                        <th>Barang</th>
                                        <th>Harga</th>
                                        <th>Qty</th>
                                        <th class="text-end">Sub Total / Item</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pesanan->barangs as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->nama_barang }}</td>
                                            <td>Rp. {{ number_format($item->harga, 0, ',', '.') }}</td>
                                            <td>{{ $item->pivot->qty }} {{ $item->satuan->satuan }}</td>
                                            <td class="text-end">Rp.
                                                {{ number_format($item->pivot->sub_total, 0, ',', '.') }}</td>

                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    {{-- <tr>
                                        <td colspan="4"></td>
                                    </tr> --}}
                                    <tr>
                                        <td colspan="3"></td>
                                        <td>Subtotal</td>
                                        <td class="text-end">Rp. {{ number_format($pesanan->sub_total, 0, ',', '.') }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"></td>
                                        <td>Diskon</td>
                                        <td class="text-end">Rp. {{ number_format($pesanan->diskon, 0, ',', '.') }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"></td>
                                        <th style="font-size: 20px">Total</th>
                                        <th style="font-size: 20px" class="text-end">Rp.
                                            {{ number_format($pesanan->total, 0, ',', '.') }}</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div> <!-- end table-responsive-->
                    </div> <!-- end col -->
                </div>
                <!-- end row -->



                <div class="d-print-none mt-4">
                    <div class="text-start">
                        @if (url()->previous() == 'http://sips.test/admin/pelanggan/1')
                            <a href="{{ route('pelanggan.show', $pesanan->pelanggan_id) }}"
                                class="btn btn-warning">Kembali</a>
                        @else
                            <a href="{{ route('pesanan.index') }}" class="btn btn-warning">Kembali</a>
                        @endif
                    </div>
                    {{-- <div class="text-end">
                        <a href="javascript:window.print()" class="btn btn-primary"><i class="ri-printer-line"></i>
                            Print</a>
                    </div> --}}
                </div>
                <!-- end buttons -->

            </div> <!-- end card -->
        </div> <!-- end col-->
    </div>
@endsection
