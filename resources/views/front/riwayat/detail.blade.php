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
{{--                        <a class="list-group-item {{ request()->is('detail-riwayat*') ? 'active' : '' }}" href="#">--}}
{{--                            <i class="bi bi-file-text-fill fa-fw me-2"></i>Detail Riwayat Pesanan</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
            <div class="col-md-9 mt-3">
                <div class="d-flex justify-content-between">
                    <h4 class="fw-semibold" style="font-size: 24px;">Detail</h4>
                    <a href="{{ route('riwayat.pesanan') }}" class="btn btn-warning">Kembali</a>
                </div>

                <div class="card mt-3">
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <th>No</th>
                                <th>Barang</th>
                                <th>Harga</th>
                                <th>Qty</th>
                                <th>Subtotal</th>
                            </thead>
                            <tbody>
                                @foreach ($pesanan_pelanggan->barangs as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama_barang }}</td>
                                        <td>Rp. {{ number_format($item->harga, 0, ',', '.') }}</td>
                                        <td>{{ $item->pivot->qty }}</td>
                                        <td>Rp. {{ number_format($item->pivot->sub_total, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <td colspan="4"><strong>Total</strong></td>
                                <td><strong>Rp. {{ number_format($pesanan_pelanggan->total, 0, ',', '.') }}</strong></td>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
