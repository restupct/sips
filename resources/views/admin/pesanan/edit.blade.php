@extends('layouts.management.master')

@section('content')
    <div class="pagetitle">
        <h1>Edit Pesanan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('pesanan.index') }}">Pesanan</a></li>
                <li class="breadcrumb-item active">Edit Pesanan</li>
            </ol>
        </nav>
    </div>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('pesanan.update', $pesanan->id) }}" method="post" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="row">
                    <div class="col-md-4 my-3">
                        <label for="no_transaksi" class="form-label">No. Transaksi</label>
                        <input type="text" name="no_transaksi"
                            value="{{ old('no_transaksi') ?? $pesanan->no_transaksi }}" class="form-control" readonly
                            id="no_transaksi" aria-describedby="no_transaksiHelp">
                    </div>

                    <div class="col-md-4 my-3">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="date" name="tanggal" value="{{ date('Y-m-d') }}" class="form-control" id="tanggal"
                            aria-describedby="tanggalHelp" onchange="ambilKwitansi()">
                    </div>

                    <div class="col-md-4 my-3">
                        <label for="pelanggan_id" class="form-label">Pelanggan</label>
                        <select class="form-select" aria-label="pelanggan_id" name="pelanggan_id">
                            <option value="">Pilih</option>
                            @foreach ($pelanggans as $val)
                                <option value="{{ $val->id }}"
                                    {{ $pesanan->pelanggan_id == $val->id ? 'selected' : '' }}>
                                    {{ $val->user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="table-responsive-sm mb-3">
                        <table class="table table-centered mb-0">
                            <thead class="table-primary">
                                <tr>
                                    <th>Aksi</th>
                                    <th>Barang</th>
                                    <th>Harga</th>
                                    <th>Qty</th>
                                    <th>Total per Item</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                                {{-- @dd($pesanan->barangs) --}}
                                @foreach ($pesanan->barangs as $item)
                                    <tr id="trItem">
                                        <td>
                                            <button class="btn btn-danger delete-row" onclick="deleteRow(this)"
                                                type="button">
                                                <i class="ri-delete-bin-7-fill"></i>
                                            </button>
                                        </td>
                                        <td>
                                            <select required name="barang_id[]" id="barang_id" class="form-select">
                                                <option value="">-- Pilih Barang --</option>
                                                @foreach ($barangs as $barang)
                                                    <option value="{{ $barang->id }}"
                                                        {{ $item->id == $barang->id ? 'selected' : '' }}>
                                                        {{ $barang->nama_barang }}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">
                                                Barang harus diisi.
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group ">
                                                <span class="input-group-text" id="hargaHelp">Rp.</span>
                                                <input required readonly type="text" name="harga_barang[]"
                                                    class="form-control" id="harga_barang"
                                                    aria-describedby="hargaBarangHelp" value="{{ $item->harga }}">
                                                <div class="invalid-feedback">Harga harus diisi.</div>
                                            </div>
                                        </td>
                                        <td>
                                            <input required type="number" name="qty[]" class="form-control"
                                                id="qty" aria-describedby="qtyHelp" value="{{ $item->pivot->qty }}">
                                            <div class="invalid-feedback">Kuantitas harus diisi.</div>
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <span class="input-group-text" id="subTotalHelp">Rp.</span>
                                                <input type="text" name="sub_total_item[]" class="form-control"
                                                    id="sub_total_item" aria-describedby="subTotalHelp"
                                                    value="{{ $item->pivot->sub_total }}">
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-6">
                        <button class="btn btn-success" type="button" onclick="addRow()">
                            <i class="ri-add-circle-line"></i> Tambah Barang
                        </button>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-centered mb-3">
                            <tr>
                                <td>
                                    <div class="row">
                                        <label for="inputSubtotal" class="col-3 col-form-label">Subtotal</label>
                                        <div class="col-9">
                                            <input type="text" name="sub_total" id="sub_total" class="form-control"
                                                aria-describedby="subTotalHelp" value="{{ $pesanan->sub_total }}">
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="row">
                                        <label for="inputSubtotal" class="col-3 col-form-label">Diskon</label>
                                        <div class="col-9">
                                            <input type="text" name="diskon" id="diskon" class="form-control"
                                                aria-describedby="diskonHelp" value="{{ $pesanan->diskon }}">
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="row">
                                        <label for="inputTotal" class="col-3 col-form-label">Total</label>
                                        <div class="col-9">
                                            <input type="text" name="total" id="total" class="form-control"
                                                aria-describedby="totalHelp" value="{{ $pesanan->total }}">
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="col d-flex justify-content-center mt-4">
                    <a class="btn btn-warning text-dark me-4" href="#">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
    </div>
@endsection
@section('js')
    <script>
        window.addEventListener('DOMContentLoaded', (event) => {
            document.querySelectorAll('#trItem').forEach(addEventListenersToRow);
            var diskonElement = document.getElementById('diskon');
            diskonElement.addEventListener('input', function() {
                var diskon = parseInt(this.value.replace(/\D/g, ''), 10) || 0;
                this.value = diskon.toLocaleString('id-ID');
                calculateTotal();
            });
        });

        function calculateTotal() {
            var total = Array.from(document.querySelectorAll('#sub_total_item'))
                .reduce(function(sum, element) {
                    return sum + (parseInt(element.value.replace(/\D/g, ''), 10) || 0);
                }, 0);
            var diskon = parseInt(document.getElementById('diskon').value.replace(/\D/g, ''), 10) || 0;
            var totalAfterDiskon = total - diskon;
            document.getElementById('sub_total').value = total.toLocaleString('id-ID');
            document.getElementById('total').value = totalAfterDiskon.toLocaleString('id-ID');
        }

        function addRow() {
            var tbody = document.getElementById('tbody');
            var newRow = document.createElement('tr');
            newRow.id = 'trItem';
            newRow.innerHTML = `
            <td>
                <button class="btn btn-danger delete-row" onclick="deleteRow(this)" type="button">
                    <i class="ri-delete-bin-7-fill"></i>
                </button>
            </td>
            <td>
                <select required name="barang_id[]" id="barang_id" class="form-select">
                    <option value="">-- Pilih Barang --</option>
                    @foreach ($barangs as $barang)
                        <option value="{{ $barang->id }}">{{ $barang->nama_barang }}</option>
                    @endforeach
                </select>
                <div class="invalid-feedback">
                    Barang harus diisi.
                </div>
            </td>
            <td>
                <div class="input-group ">
                    <span class="input-group-text" id="hargaHelp">Rp.</span>
                    <input required readonly type="text" name="harga_barang[]"
                        class="form-control" id="harga_barang" aria-describedby="hargaBarangHelp">
                    <div class="invalid-feedback">Harga harus diisi.</div>
                </div>
            </td>
            <td>
                <input required type="number" name="qty[]" class="form-control" id="qty"
                    aria-describedby="qtyHelp">
                <div class="invalid-feedback">Kuantitas harus diisi.</div>
            </td>
            <td>
                <div class="input-group">
                    <span class="input-group-text" id="subTotalHelp">Rp.</span>
                    <input type="text" name="sub_total_item[]" class="form-control" id="sub_total_item"
                        aria-describedby="subTotalHelp">
                </div>
            </td>
            `;
            tbody.appendChild(newRow);
            addEventListenersToRow(newRow);
        }

        function calculateTotal() {
            var total = Array.from(document.querySelectorAll('#sub_total_item'))
                .reduce(function(sum, element) {
                    return sum + (parseInt(element.value.replace(/\D/g, ''), 10) || 0);
                }, 0);
            var diskon = parseInt(document.getElementById('diskon').value.replace(/\D/g, ''), 10) || 0;
            var totalAfterDiskon = total - diskon;
            document.getElementById('sub_total').value = total.toLocaleString('id-ID');
            document.getElementById('total').value = totalAfterDiskon.toLocaleString('id-ID');
        }

        function addEventListenersToRow(row) {
            var barangIdElement = row.querySelector('#barang_id');
            var hargaBarangElement = row.querySelector('#harga_barang');
            var qtyElement = row.querySelector('#qty');
            var subTotalElement = row.querySelector('#sub_total_item');

            barangIdElement.addEventListener('change', function() {
                var barangId = this.value;
                if (barangId) {
                    fetch('/admin/getbarang/' + barangId)
                        .then(response => response.json())
                        .then(data => {
                            if (data) {
                                var harga = data.harga;
                                var formattedHarga = parseInt(harga).toLocaleString('id-ID');
                                hargaBarangElement.value = formattedHarga;
                                calculateSubTotal();
                            } else {
                                hargaBarangElement.value = '';
                            }
                        });
                } else {
                    hargaBarangElement.value = '';
                }
            });

            qtyElement.addEventListener('input', calculateSubTotal);

            function calculateSubTotal() {
                var harga = parseInt(hargaBarangElement.value.replace(/\D/g, ''), 10) || 0;
                var qty = parseInt(qtyElement.value, 10) || 0;
                var subTotal = harga * qty;
                subTotalElement.value = subTotal.toLocaleString('id-ID');
                calculateTotal();
            }
        }

        function deleteRow(btn) {
            var row = btn.parentNode.parentNode;
            row.parentNode.removeChild(row);
        }
        $(document).ready(function() {
            $('#barang_id').change(function() {
                var barangId = $(this).val();
                if (barangId) {
                    $.ajax({
                        type: 'GET',
                        url: '/admin/getbarang/' + barangId,
                        dataType: 'json',
                        success: function(data) {
                            if (data) {
                                $('#harga_barang').val(data.harga);
                            } else {
                                $('#harga_barang').val('');
                            }
                        }
                    });
                } else {
                    $('#inputsatuan').val('');
                    $('#harga_barang').val('');
                }
            });
        });
    </script>
@endsection
