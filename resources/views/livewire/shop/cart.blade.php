{{--@dump(session()->all())--}}
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <th>Nama Barang</th>
                            <th>Harga</th>
                            {{-- <th>Qty</th> --}}
                            {{-- <th>Total</th> --}}
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach ($cart['barangs'] as $key => $item)
                                <tr wire:key="{{ $key }}">
                                    <td>{{ $item['nama_barang'] }}</td>
                                    <td> {{ $item['harga'] }}</td>
                                    <td>
                                        <input type="number" class="form-control" name="qty" id="" value="{{$item['qty']}}"  wire:change="updateQty({{ $item['id'] }}, $event.target.value)">
                                    </td>
                                    {{-- <td><input type="number" wire:model="qty" name="qty" id="qty"
                                            class="form-control" style="width: 100px"></td> --}}
                                    {{-- <td><input type="text" wire:model="totalHargaPerBarang" class="form-control"> --}}
                                    </td>
                                    <td><button wire:click="removeFromCart({{ $item['id'] }})"
                                            class="btn btn-sm btn-danger">Hapus</button></td>
                                </tr>
                            @endforeach
                            <tr>
                                <td>Total :</td>
                                <td><input class="form-control" type="text" name="sub_total" id="sub_total"
                                        wire:model="total">
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td><button wire:click="pesan" class="btn btn-primary float-right">Pesan</button></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
