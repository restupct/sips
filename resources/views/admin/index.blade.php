@extends('layouts.management.master')

@section('content')
    <div class="pagetitle">
        <div style="display: flex; align-items: baseline;">
            <h1 class="me-3">Dashboard</h1>
            <h4>
                <span class="badge bg-primary">
                    @if (request('bulanAwal'))
                        {{ \Carbon\Carbon::parse(request('bulanAwal'))->locale('id')->isoFormat('MMMM Y') }}
                        @if (request('bulanAkhir'))
                            -
                            {{ \Carbon\Carbon::parse(request('bulanAkhir'))->locale('id')->isoFormat('MMMM Y') }}
                        @endif
                    @elseif (request('bulanAkhir'))
                        {{ \Carbon\Carbon::parse(request('bulanAkhir'))->locale('id')->isoFormat('MMMM Y') }}
                    @else
                        {{ \Carbon\Carbon::parse(date('F'))->locale('id')->isoFormat('MMMM Y') }}
                    @endif
                </span>
            </h4>
        </div>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
        {{-- <div class="card">
            <div class="card-body">
                <form action="#">
                    <div class="row mt-3 justify-content-center">
                        <div class="col-md-4">
                            <label for="bulanAwal">Bulan Awal</label>
                            <input type="month" class="form-control" name="bulanAwal" id="bulanAwal">
                        </div>
                        <div class="col-md-4">
                            <label for="bulanAwal">Bulan Akhir</label>
                            <input type="month" class="form-control" name="bulanAkhir" id="bulanAkhir">
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary" type="submit"><i class="bi bi-filter-circle"></i></button>
                            <button class="btn btn-primary" type="submit"><i class="bi bi-search-circle"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div> --}}
    </div>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <section class="section dashboard">
        {{-- <div class="row mb-4 justify-content-center">
            <div class="col-md-3"><input type="text" name="bulanAwal" id="bulanAwal" class="form-control"
                    placeholder="Bulan Awal"></div>
            <div class="col-md-3"><input type="text" name="bulanAkhir" id="bulanAkhir" class="form-control"
                    placeholder="Bulan Akhir"></div>
        </div> --}}

        <div class="row">
            <div class="col-md-4">
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <h5 class="card-title">Total Pesanan
                            {{-- <span>| Hari Ini</span> --}}
                        </h5>

                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-cart"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ @$jumlahPesanan }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Jumlah Pesanan Selesai Card -->
            <div class="col-md-4">
                <a href="{{ url('/admin/pesanan?status=Belum+Diproses') }}">
                    <div class="card info-card customers-card">
                        <div class="card-body">
                            <h5 class="card-title">Pesanan Belum Diproses</h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-cart"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>{{ @$jumlahPesananBelumDiproses }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <!-- END Jumlah Pesanan Selesai Card -->
            <!-- Jumlah Pesanan Selesai Card -->
            <div class="col-md-4">
                <a href="{{ url('/admin/pesanan?status=Selesai') }}">
                    <div class="card info-card revenue-card">
                        <div class="card-body">
                            <h5 class="card-title">Jumlah Pesanan Selesai</h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-cart"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>{{ @$jumlahPesananSelesai }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <!-- END Jumlah Pesanan Selesai Card -->
            <div class="col-md-4">
                <div class="card info-card revenue-card">

                    {{-- <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6>Filter</h6>
                            </li>

                            <li><a class="dropdown-item" href="#">Today</a></li>
                            <li><a class="dropdown-item" href="#">This Month</a></li>
                            <li><a class="dropdown-item" href="#">This Year</a></li>
                        </ul>
                    </div> --}}

                    <div class="card-body">
                        <h5 class="card-title">Pendapatan</h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <span class="fw-bold">Rp.</span>
                            </div>
                            <div class="ps-3">
                                <h6>{{ number_format(@$pendapatan, 0, ',', '.') }}</h6>
                                {{-- <span class="text-success small pt-1 fw-bold">8%</span> <span
                                    class="text-muted small pt-2 ps-1">increase</span> --}}
                            </div>
                        </div>
                    </div>

                </div>
            </div><!-- End Revenue Card -->
            <div class="col-md-4">
                <div class="card info-card customers-card">
                    <div class="card-body">
                        <h5 class="card-title">Pengeluaran</h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <span class="fw-bold">Rp.</span>
                            </div>
                            <div class="ps-3">
                                <h6>{{ number_format(@$pengeluaran, 0, ',', '.') }}</h6>
                                {{-- <span class="text-danger small pt-1 fw-bold">12%</span> <span
                                    class="text-muted small pt-2 ps-1">decrease</span> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- End Pelanggan Card -->
            <div class="col-md-4">
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <h5 class="card-title">Pelanggan</h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-people"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ @$jumlahPelanggan }}</h6>
                                {{-- <span class="text-danger small pt-1 fw-bold">12%</span> <span
                                    class="text-muted small pt-2 ps-1">decrease</span> --}}
                            </div>
                        </div>

                    </div>
                </div>
            </div><!-- End Pelanggan Card -->
        </div>

        {{-- Grafik --}}
        <div class="card">
            <div class="filter">
                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                        <h6>Filter</h6>
                    </li>

                    {{-- <li><a class="dropdown-item" href="{{ url('admin/dashboard' . '?filter=hari-ini') }}">Hari Ini</a>
                    </li> --}}
                    <li><a class="dropdown-item" href="{{ url('admin/dashboard' . '?filter=minggu-ini') }}">Minggu Ini</a>
                    </li>
                    <li><a class="dropdown-item" href="{{ url('admin/dashboard' . '?filter=bulan-ini') }}">Bulan Ini</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <h5 class="card-title">Laporan
                    @if (request('filter') == 'minggu-ini')
                        <span>/Minggu Ini</span>
                    @else
                        <span>/Bulan Ini</span>
                    @endif
                </h5>
                <canvas id="grafiknew" style="max-height: 400px;"></canvas>

            </div>
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", () => {
                new Chart(document.querySelector('#grafiknew'), {
                    type: 'line',
                    data: {
                        labels: {!! json_encode($tanggal) !!},
                        datasets: [{
                                label: 'Pendapatan',
                                data: {!! json_encode($pendapatanPerTanggal) !!},
                                fill: false,
                                borderColor: 'rgb(46,202,106)',
                                tension: 0.1
                            },
                            {
                                label: 'Pengeluaran',
                                data: {!! json_encode($pengeluarans) !!},
                                fill: false,
                                borderColor: 'rgb(255,119,29)',
                                tension: 0.1
                            }
                        ]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    // Include a comma in the ticks
                                    callback: function(value, index, values) {
                                        return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                                    }
                                }
                            }
                        },
                        tooltips: {
                            callbacks: {
                                label: function(tooltipItem, data) {
                                    var label = data.datasets[tooltipItem.datasetIndex].label || '';

                                    if (label) {
                                        label += ': ';
                                    }
                                    label += tooltipItem.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g,
                                        ".");
                                    return label;
                                }
                            }
                        }
                    }
                });
            });
        </script>

        <div class="row">
            <!-- Pesanan Terakhir -->
            <div class="col-8">
                <div class="card recent-sales overflow-auto">
                    {{-- <div class="filter">
                    <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <li class="dropdown-header text-start">
                            <h6>Filter</h6>
                        </li>

                        <li><a class="dropdown-item" href="#">Today</a></li>
                        <li><a class="dropdown-item" href="#">This Month</a></li>
                        <li><a class="dropdown-item" href="#">This Year</a></li>
                    </ul>
                </div> --}}

                    <div class="card-body">
                        <h5 class="card-title">Pesanan Terakhir</h5>
                        <table class="table table-borderless datatable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Pelanggan</th>
                                    <th scope="col">Barang</th>
                                    <th scope="col">Total Harga</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pesanans as $pesanan)
                                    <tr>
                                        <th scope="row"><a
                                                href="{{ route('pesanan.show', $pesanan->id) }}">{{ $pesanan->no_transaksi }}</a>
                                        </th>
                                        <td>{{ $pesanan->pelanggan->user->name }}</td>
                                        <td>{{ implode(', ', $pesanan->barangs->pluck('nama_barang')->toArray()) }}</td>
                                        <td>Rp. {{ number_format($pesanan->total, 0, ',', '.') }}</td>
                                        <td>
                                            @if ($pesanan->status == 'Selesai')
                                                <span class="badge bg-success">{{ $pesanan->status }}</span>
                                            @else
                                                <span class="badge bg-warning">{{ $pesanan->status }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>

                </div>
            </div><!-- End Recent Sales -->
            <!-- Stok Barang Akan Habis -->
            <div class="col-4">
                <div class="card recent-sales overflow-auto">
                    <div class="card-body">
                        <h5 class="card-title">Stok Barang Akan Habis</h5>
                        <table class="table table-borderless datatable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Barang</th>
                                    <th scope="col">Sisa Stok</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($barangs as $barang)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $barang->nama_barang }}</td>
                                        <td>{{ $barang->stok }} {{ $barang->satuan->satuan }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>

                </div>
            </div><!-- End Recent Sales -->
        </div>
    </section>
@endsection
