@extends('layouts.front.app')
@section('content')
    <div class="container">
        <div class="row mt-4 pt-4">
{{--            <div class="col-md-3">--}}
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
            <div class="col-md-9 mt-3">
                <h4 class="fw-semibold" style="font-size: 24px;">Riwayat Pesanan</h4>

                @foreach ($pesanan_pelanggans as $pesanan_pelanggan)
                    <div class="card bg-transparent border">
                        <div class="card-body border-bottom d-flex justify-content-between">
                            <div class="d-sm-flex">
                                <!-- Info -->
                                <div class="ms-0 ms-sm-2">
                                    <div class="d-sm-flex align-items-center mb-2">
                                        <span class="text-body small">No. Transaksi :
                                            {{ $pesanan_pelanggan->no_transaksi }}</span>
                                    </div>
                                    <small class="text-dark me-2">Tanggal :
                                        {{ \Carbon\Carbon::parse($pesanan_pelanggan->tanggal)->locale('id')->isoFormat('D MMMM Y') }}</small>
                                    @if ($pesanan_pelanggan->status == 'Belum Diproses')
                                        <div
                                            class="badge bg-primary bg-opacity-10 text-primary border border-primary rounded-pill fw-semibold me-2">
                                            Belum Diproses</div>
                                    @elseif ($pesanan_pelanggan->status == 'Diproses')
                                        <div
                                            class="badge bg-warning bg-opacity-10 text-warning border border-warning rounded-pill fw-semibold me-2">
                                            Diproses</div>
                                    @elseif ($pesanan_pelanggan->status == 'Dikirim')
                                        <div
                                            class="badge bg-info bg-opacity-10 text-info border border-info rounded-pill fw-semibold me-2">
                                            Dikirim</div>
                                    @elseif ($pesanan_pelanggan->status == 'Selesai')
                                        <div
                                            class="badge bg-success bg-opacity-10 text-success border border-success rounded-pill fw-semibold me-2">
                                            Selesai</div>
                                    @endif
                                </div>
                            </div>

                            <div class="border-start border-3 border-secondary ps-2">
                                <small>Total Belanja</small>
                                <h6>Rp. {{ number_format($pesanan_pelanggan->total, 0, ',', '.') }}</h6>
                                <div class="d-flex align-items-center">
                                    <a href="{{ route('detail.riwayat.pesanan', $pesanan_pelanggan->id) }}"
                                        class="text-gradient me-2">Lihat
                                        Detail Transaksi</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            {{-- @dump($pesanan_pelanggans) --}}
        </div>
    </div>
@endsection
